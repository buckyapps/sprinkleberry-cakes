<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_subscribers_table_name() {
	global $wpdb;
	return $wpdb->prefix . 'sb_subscribers';
}

function sprinkleberry_subscribers_install() {
	global $wpdb;
	$table   = sprinkleberry_subscribers_table_name();
	$charset = $wpdb->get_charset_collate();
	$sql     = "CREATE TABLE $table (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		email varchar(190) NOT NULL,
		created_at datetime NOT NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY email (email)
	) $charset;";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
add_action( 'after_setup_theme', 'sprinkleberry_subscribers_install' );

function sprinkleberry_handle_subscribe() {
	if ( ! isset( $_POST['sprinkleberry_subscribe_nonce'] ) ||
		! wp_verify_nonce( $_POST['sprinkleberry_subscribe_nonce'], 'sprinkleberry_subscribe' ) ) {
		wp_safe_redirect( home_url( '/' ) );
		exit;
	}

	$email = sanitize_email( wp_unslash( $_POST['berry_email'] ?? '' ) );
	if ( ! is_email( $email ) ) {
		wp_safe_redirect( home_url( '/#berries' ) );
		exit;
	}

	global $wpdb;
	$table = sprinkleberry_subscribers_table_name();
	$exists = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $table WHERE email = %s", $email ) );

	if ( $exists ) {
		wp_safe_redirect( home_url( '/?berry=exists#berries' ) );
		exit;
	}

	$wpdb->insert(
		$table,
		array(
			'email'      => $email,
			'created_at' => current_time( 'mysql' ),
		),
		array( '%s', '%s' )
	);

	wp_mail(
		'Raoreggia@gmail.com',
		'New Sprinkle Berry signup',
		"A new Sprinkle Berry joined the list:\n\n" . $email
	);

	wp_safe_redirect( home_url( '/?berry=1#berries' ) );
	exit;
}
add_action( 'admin_post_nopriv_sprinkleberry_subscribe', 'sprinkleberry_handle_subscribe' );
add_action( 'admin_post_sprinkleberry_subscribe', 'sprinkleberry_handle_subscribe' );

function sprinkleberry_subscribers_menu() {
	add_menu_page(
		'Sprinkle Berries',
		'Sprinkle Berries',
		'manage_options',
		'sprinkleberry-subscribers',
		'sprinkleberry_subscribers_page',
		'dashicons-email-alt',
		26
	);
}
add_action( 'admin_menu', 'sprinkleberry_subscribers_menu' );

function sprinkleberry_export_subscribers() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( ! isset( $_GET['page'], $_GET['sb_export'] ) || $_GET['page'] !== 'sprinkleberry-subscribers' || $_GET['sb_export'] !== 'csv' ) {
		return;
	}
	global $wpdb;
	$table  = sprinkleberry_subscribers_table_name();
	$emails = $wpdb->get_results( "SELECT email, created_at FROM $table ORDER BY id ASC", ARRAY_A );
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=sprinkle-berries.csv' );
	$out = fopen( 'php://output', 'w' );
	fputcsv( $out, array( 'email', 'signed_up' ) );
	foreach ( $emails as $row ) {
		fputcsv( $out, array( $row['email'], $row['created_at'] ) );
	}
	fclose( $out );
	exit;
}
add_action( 'admin_init', 'sprinkleberry_export_subscribers' );

function sprinkleberry_subscribers_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;
	$table = sprinkleberry_subscribers_table_name();

	if ( isset( $_POST['sb_send_newsletter'] ) &&
		isset( $_POST['sb_news_nonce'] ) &&
		wp_verify_nonce( $_POST['sb_news_nonce'], 'sb_news' ) ) {
		$subject = sanitize_text_field( wp_unslash( $_POST['sb_subject'] ?? '' ) );
		$body    = wp_kses_post( wp_unslash( $_POST['sb_body'] ?? '' ) );
		$emails  = $wpdb->get_col( "SELECT email FROM $table ORDER BY id ASC" );
		$sent    = 0;
		foreach ( $emails as $to ) {
			if ( wp_mail( $to, $subject, wp_strip_all_tags( $body ) ) ) {
				$sent++;
			}
		}
		echo '<div class="notice notice-success"><p>Sent to ' . intval( $sent ) . ' Sprinkle Berries.</p></div>';
	}

	$rows = $wpdb->get_results( "SELECT email, created_at FROM $table ORDER BY id DESC" );
	$count = is_array( $rows ) ? count( $rows ) : 0;
	$export_url = admin_url( 'admin.php?page=sprinkleberry-subscribers&sb_export=csv' );
	?>
	<div class="wrap">
		<h1>Sprinkle Berries</h1>
		<p><?php echo intval( $count ); ?> people have joined the bakery list.</p>
		<p><a class="button button-primary" href="<?php echo esc_url( $export_url ); ?>">Download email list (CSV)</a></p>

		<h2>Send an update</h2>
		<p>This emails everyone on the list. Use it for promotions, new flavors, or bakery news.</p>
		<form method="post">
			<?php wp_nonce_field( 'sb_news', 'sb_news_nonce' ); ?>
			<p>
				<label>Subject<br>
					<input type="text" name="sb_subject" class="regular-text" required>
				</label>
			</p>
			<p>
				<label>Message<br>
					<textarea name="sb_body" rows="8" class="large-text" required></textarea>
				</label>
			</p>
			<p><button type="submit" name="sb_send_newsletter" class="button button-primary">Send to Sprinkle Berries</button></p>
		</form>

		<h2>Email list</h2>
		<table class="widefat striped">
			<thead>
				<tr><th>Email</th><th>Signed up</th></tr>
			</thead>
			<tbody>
			<?php if ( $rows ) : ?>
				<?php foreach ( $rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row->email ); ?></td>
						<td><?php echo esc_html( $row->created_at ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr><td colspan="2">No signups yet.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}
