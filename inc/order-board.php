<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Private order board password.
 * Change this string if Raquel wants a different password.
 */
function sprinkleberry_board_password() {
	return 'RaquelBerry';
}

function sprinkleberry_board_cookie() {
	return 'sbc_board';
}

function sprinkleberry_board_token() {
	return hash_hmac( 'sha256', sprinkleberry_board_password(), wp_salt( 'auth' ) );
}

function sprinkleberry_board_logged_in() {
	$cookie = isset( $_COOKIE[ sprinkleberry_board_cookie() ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ sprinkleberry_board_cookie() ] ) ) : '';
	return $cookie !== '' && hash_equals( sprinkleberry_board_token(), $cookie );
}

function sprinkleberry_board_set_cookie() {
	setcookie(
		sprinkleberry_board_cookie(),
		sprinkleberry_board_token(),
		array(
			'expires'  => time() + 30 * DAY_IN_SECONDS,
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'secure'   => is_ssl(),
			'httponly' => true,
			'samesite' => 'Lax',
		)
	);
	$_COOKIE[ sprinkleberry_board_cookie() ] = sprinkleberry_board_token();
}

function sprinkleberry_board_clear_cookie() {
	setcookie(
		sprinkleberry_board_cookie(),
		'',
		array(
			'expires'  => time() - HOUR_IN_SECONDS,
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'secure'   => is_ssl(),
			'httponly' => true,
			'samesite' => 'Lax',
		)
	);
	unset( $_COOKIE[ sprinkleberry_board_cookie() ] );
}

function sprinkleberry_order_statuses() {
	return array(
		'new'       => 'New',
		'confirmed' => 'Confirmed',
		'done'      => 'Done',
	);
}

function sprinkleberry_handle_board() {
	if ( ! is_page( 'orders' ) ) {
		return;
	}

	if ( isset( $_POST['sbc_board_action'] ) ) {
		$action = sanitize_text_field( wp_unslash( $_POST['sbc_board_action'] ) );

		if ( $action === 'login' ) {
			$pass = isset( $_POST['sbc_board_pass'] ) ? (string) wp_unslash( $_POST['sbc_board_pass'] ) : '';
			if ( hash_equals( sprinkleberry_board_password(), $pass ) ) {
				sprinkleberry_board_set_cookie();
			}
			wp_safe_redirect( home_url( '/orders/' ) );
			exit;
		}

		if ( $action === 'logout' ) {
			sprinkleberry_board_clear_cookie();
			wp_safe_redirect( home_url( '/orders/' ) );
			exit;
		}

		if ( $action === 'status' && sprinkleberry_board_logged_in() ) {
			check_admin_referer( 'sbc_board_status' );
			$id     = isset( $_POST['order_id'] ) ? absint( $_POST['order_id'] ) : 0;
			$status = isset( $_POST['status'] ) ? sanitize_text_field( wp_unslash( $_POST['status'] ) ) : '';
			$ok     = $id && get_post_type( $id ) === 'sbc_order' && isset( sprinkleberry_order_statuses()[ $status ] );
			if ( $ok ) {
				update_post_meta( $id, 'sbc_status', $status );
			}
			wp_safe_redirect( home_url( '/orders/' ) );
			exit;
		}
	}
}
add_action( 'template_redirect', 'sprinkleberry_handle_board' );

function sprinkleberry_board_orders() {
	$posts = get_posts(
		array(
			'post_type'      => 'sbc_order',
			'post_status'    => 'private',
			'posts_per_page' => 100,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);
	$orders = array();
	foreach ( $posts as $post ) {
		$status = get_post_meta( $post->ID, 'sbc_status', true );
		if ( ! $status ) {
			$status = 'new';
		}
		$orders[] = array(
			'id'      => $post->ID,
			'date'    => get_the_date( 'M j, g:i a', $post ),
			'name'    => get_post_meta( $post->ID, 'sbc_name', true ),
			'email'   => get_post_meta( $post->ID, 'sbc_email', true ),
			'phone'   => get_post_meta( $post->ID, 'sbc_phone', true ),
			'type'    => get_post_meta( $post->ID, 'sbc_type', true ),
			'details' => get_post_meta( $post->ID, 'sbc_details', true ),
			'status'  => $status,
		);
	}
	return $orders;
}
