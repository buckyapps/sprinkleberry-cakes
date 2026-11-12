<?php
if ( ! isset( $order ) ) {
	return;
}
$due_label = '';
if ( ! empty( $order['due'] ) ) {
	$due_label = date_i18n( 'M j, Y', strtotime( $order['due'] ) );
}
?>
<article class="board-card status-<?php echo esc_attr( $order['status'] ); ?>">
	<label class="board-check">
		<input type="checkbox" name="order_ids[]" value="<?php echo esc_attr( $order['id'] ); ?>">
	</label>
	<div class="board-card-top">
		<strong><?php echo esc_html( $order['name'] ); ?></strong>
		<span><?php echo esc_html( $order['date'] ); ?></span>
	</div>
	<p class="board-type"><?php echo esc_html( $order['type'] ); ?></p>
	<?php if ( $due_label ) : ?>
		<p class="board-due">Needed <?php echo esc_html( $due_label ); ?></p>
	<?php endif; ?>
	<?php if ( $order['phone'] ) : ?>
		<a class="board-link" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $order['phone'] ) ); ?>"><?php echo esc_html( $order['phone'] ); ?></a>
	<?php endif; ?>
	<?php if ( $order['email'] ) : ?>
		<a class="board-link" href="mailto:<?php echo esc_attr( $order['email'] ); ?>"><?php echo esc_html( $order['email'] ); ?></a>
	<?php endif; ?>
	<?php if ( $order['details'] ) : ?>
		<p class="board-details"><?php echo esc_html( $order['details'] ); ?></p>
	<?php endif; ?>
	<form class="board-date" method="post">
		<input type="hidden" name="sbc_board_action" value="date">
		<input type="hidden" name="order_id" value="<?php echo esc_attr( $order['id'] ); ?>">
		<?php wp_nonce_field( 'sbc_board_status' ); ?>
		<label>Date needed</label>
		<input type="date" name="due_date" value="<?php echo esc_attr( $order['due'] ?? '' ); ?>" onchange="this.form.submit()">
	</form>
	<div class="board-actions">
		<form class="board-status" method="post">
			<input type="hidden" name="sbc_board_action" value="status">
			<input type="hidden" name="order_id" value="<?php echo esc_attr( $order['id'] ); ?>">
			<?php wp_nonce_field( 'sbc_board_status' ); ?>
			<button type="submit" name="status" value="new" class="<?php echo $order['status'] === 'new' ? 'is-on' : ''; ?>">New</button>
			<button type="submit" name="status" value="confirmed" class="<?php echo $order['status'] === 'confirmed' ? 'is-on' : ''; ?>">Confirmed</button>
			<button type="submit" name="status" value="done" class="<?php echo $order['status'] === 'done' ? 'is-on' : ''; ?>">Done</button>
		</form>
		<form method="post" onsubmit="return confirm('Cancel order?');">
			<input type="hidden" name="sbc_board_action" value="remove">
			<input type="hidden" name="order_id" value="<?php echo esc_attr( $order['id'] ); ?>">
			<?php wp_nonce_field( 'sbc_board_status' ); ?>
			<button type="submit" class="board-remove">Cancel</button>
		</form>
	</div>
</article>
