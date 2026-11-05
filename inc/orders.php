<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_order_labels() {
	return array(
		'custom-cake'  => 'Artisan Cakes',
		'cupcakes'     => 'Cupcakes',
		'desserts'     => 'Desserts',
		'cheesecake'   => 'Cheesecakes',
		'sweet-treats' => 'Sweet Treats',
		'pies'         => 'Pies',
		'other'        => 'Other / Question',
	);
}

function sprinkleberry_register_orders() {
	register_post_type(
		'sbc_order',
		array(
			'labels' => array(
				'name'          => 'Order Requests',
				'singular_name' => 'Order Request',
				'edit_item'     => 'View Order Request',
				'all_items'     => 'All Requests',
			),
			'public'       => false,
			'show_ui'      => true,
			'menu_icon'    => 'dashicons-email-alt',
			'menu_position'=> 22,
			'supports'     => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'sprinkleberry_register_orders' );

function sprinkleberry_handle_order_form() {
	if ( ! isset( $_POST['sprinkleberry_order_nonce'] ) ||
		! wp_verify_nonce( $_POST['sprinkleberry_order_nonce'], 'sprinkleberry_order' ) ) {
		wp_safe_redirect( home_url( '/about/#contact' ) );
		exit;
	}

	$labels  = sprinkleberry_order_labels();
	$name    = sanitize_text_field( wp_unslash( $_POST['order_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['order_email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['order_phone'] ?? '' ) );
	$type    = sanitize_text_field( wp_unslash( $_POST['order_type'] ?? '' ) );
	$details = sanitize_textarea_field( wp_unslash( $_POST['order_message'] ?? '' ) );
	$label   = $labels[ $type ] ?? $type;

	if ( ! $name || ! $email ) {
		wp_safe_redirect( home_url( '/about/?order=missing#contact' ) );
		exit;
	}

	$order_id = wp_insert_post(
		array(
			'post_type'   => 'sbc_order',
			'post_status' => 'private',
			'post_title'  => $name . ' — ' . $label,
		)
	);
	if ( $order_id && ! is_wp_error( $order_id ) ) {
		update_post_meta( $order_id, 'sbc_name', $name );
		update_post_meta( $order_id, 'sbc_email', $email );
		update_post_meta( $order_id, 'sbc_phone', $phone );
		update_post_meta( $order_id, 'sbc_type', $label );
		update_post_meta( $order_id, 'sbc_details', $details );
	}

	$to      = 'Raoreggia@gmail.com';
	$subject = 'New Sprinkle Berry order request — ' . $label;
	$phone_line = $phone !== '' ? $phone : 'Not provided';
	$details_block = $details !== '' ? $details : 'No extra details were written in.';

	$body  = "A new order request came in from sprinkleberrybyraquel.com\n\n";
	$body .= "CONTACT\n";
	$body .= "Name: {$name}\n";
	$body .= "Email: {$email}\n";
	$body .= "Phone: {$phone_line}\n";
	$body .= "Ordering: {$label}\n\n";
	$body .= "DETAILS\n";
	$body .= $details_block . "\n";

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'From: Sprinkle Berry Cakes <noreply@' . wp_parse_url( home_url(), PHP_URL_HOST ) . '>',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/about/?order=success#contact' ) );
	exit;
}
add_action( 'admin_post_nopriv_sprinkleberry_order', 'sprinkleberry_handle_order_form' );
add_action( 'admin_post_sprinkleberry_order', 'sprinkleberry_handle_order_form' );

function sprinkleberry_order_columns( $cols ) {
	return array(
		'cb'         => $cols['cb'],
		'title'      => 'Customer',
		'sbc_email'  => 'Email',
		'sbc_phone'  => 'Phone',
		'sbc_type'   => 'Ordering',
		'date'       => 'Received',
	);
}
add_filter( 'manage_sbc_order_posts_columns', 'sprinkleberry_order_columns' );

function sprinkleberry_order_column_values( $col, $post_id ) {
	if ( in_array( $col, array( 'sbc_email', 'sbc_phone', 'sbc_type' ), true ) ) {
		echo esc_html( (string) get_post_meta( $post_id, $col, true ) );
	}
}
add_action( 'manage_sbc_order_posts_custom_column', 'sprinkleberry_order_column_values', 10, 2 );

function sprinkleberry_order_metabox() {
	add_meta_box(
		'sbc_order_details',
		'Request',
		'sprinkleberry_order_metabox_html',
		'sbc_order',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'sprinkleberry_order_metabox' );

function sprinkleberry_order_metabox_html( $post ) {
	$fields = array(
		'sbc_name'    => 'Name',
		'sbc_email'   => 'Email',
		'sbc_phone'   => 'Phone',
		'sbc_type'    => 'Ordering',
		'sbc_details' => 'Details',
	);
	echo '<table class="form-table">';
	foreach ( $fields as $key => $label ) {
		$val = get_post_meta( $post->ID, $key, true );
		echo '<tr><th>' . esc_html( $label ) . '</th><td style="white-space:pre-wrap;">' . esc_html( $val ) . '</td></tr>';
	}
	echo '</table>';
}
