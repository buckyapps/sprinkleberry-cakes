<?php
/**
 * Template Name: Private Orders
 */
get_header();

$logged_in = sprinkleberry_board_logged_in();
$orders    = $logged_in ? sprinkleberry_board_orders() : array();
$statuses  = sprinkleberry_order_statuses();
?>
<main id="main" class="order-board">
	<section class="section">
		<div class="container">
			<?php if ( ! $logged_in ) : ?>
				<div class="board-login">
					<h1>Order requests</h1>
					<p>For Raquel only. Enter the bakery password.</p>
					<form method="post">
						<input type="hidden" name="sbc_board_action" value="login">
						<label class="screen-reader" for="sbc_board_pass">Password</label>
						<input type="password" id="sbc_board_pass" name="sbc_board_pass" placeholder="Password" required>
						<button type="submit" class="btn btn-primary">Open orders</button>
					</form>
				</div>
			<?php else : ?>
				<div class="board-head">
					<div>
						<h1>Order requests</h1>
						<p><?php echo count( $orders ); ?> saved</p>
					</div>
					<form method="post">
						<input type="hidden" name="sbc_board_action" value="logout">
						<button type="submit" class="btn btn-outline">Lock</button>
					</form>
				</div>

				<?php if ( empty( $orders ) ) : ?>
					<p class="board-empty">No order requests yet. New ones from the website will show up here.</p>
				<?php else : ?>
					<div class="board-list">
						<?php foreach ( $orders as $order ) : ?>
							<article class="board-card status-<?php echo esc_attr( $order['status'] ); ?>">
								<div class="board-card-top">
									<strong><?php echo esc_html( $order['name'] ); ?></strong>
									<span><?php echo esc_html( $order['date'] ); ?></span>
								</div>
								<p class="board-type"><?php echo esc_html( $order['type'] ); ?></p>
								<?php if ( $order['phone'] ) : ?>
									<a class="board-link" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $order['phone'] ) ); ?>"><?php echo esc_html( $order['phone'] ); ?></a>
								<?php endif; ?>
								<?php if ( $order['email'] ) : ?>
									<a class="board-link" href="mailto:<?php echo esc_attr( $order['email'] ); ?>"><?php echo esc_html( $order['email'] ); ?></a>
								<?php endif; ?>
								<?php if ( $order['details'] ) : ?>
									<p class="board-details"><?php echo esc_html( $order['details'] ); ?></p>
								<?php endif; ?>
								<form class="board-status" method="post">
									<input type="hidden" name="sbc_board_action" value="status">
									<input type="hidden" name="order_id" value="<?php echo esc_attr( $order['id'] ); ?>">
									<?php wp_nonce_field( 'sbc_board_status' ); ?>
									<?php foreach ( $statuses as $key => $label ) : ?>
										<button type="submit" name="status" value="<?php echo esc_attr( $key ); ?>" class="<?php echo $order['status'] === $key ? 'is-on' : ''; ?>"><?php echo esc_html( $label ); ?></button>
									<?php endforeach; ?>
								</form>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
