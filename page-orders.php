<?php
/**
 * Template Name: Private Orders
 */
get_header();

$logged_in = sprinkleberry_board_logged_in();
$orders    = $logged_in ? sprinkleberry_board_orders() : array();
$active    = array();
$past      = array();
foreach ( $orders as $order ) {
	if ( $order['status'] === 'done' ) {
		$past[] = $order;
	} else {
		$active[] = $order;
	}
}
?>
<main id="main" class="order-board">
	<section class="section">
		<div class="container">
			<?php if ( ! $logged_in ) : ?>
				<div class="board-login">
					<h1>Order requests</h1>
					<p>For Raquel only. Enter the bakery password.</p>
					<?php if ( isset( $_GET['bad'] ) ) : ?><p class="board-bad">That password did not match. Try RaquelBerry.</p><?php endif; ?>
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
						<p><?php echo count( $active ); ?> open</p>
					</div>
					<div class="board-tools">
						<button type="button" class="btn btn-outline board-edit-btn" id="board-edit">Edit</button>
						<form method="post" onsubmit="return confirm('Cancel all orders?');">
							<input type="hidden" name="sbc_board_action" value="remove_all">
							<?php wp_nonce_field( 'sbc_board_status' ); ?>
							<button type="submit" class="board-remove">Delete all</button>
						</form>
						<form method="post">
							<input type="hidden" name="sbc_board_action" value="logout">
							<button type="submit" class="btn btn-outline">Lock</button>
						</form>
					</div>
				</div>

				<div class="board-bulk-bar">
					<button type="button" class="btn btn-primary" id="delete-selected">Delete selected</button>
				</div>

				<?php if ( empty( $active ) ) : ?>
					<p class="board-empty">No open orders. New requests from the website will show up here.</p>
				<?php else : ?>
					<div class="board-list">
						<?php foreach ( $active as $order ) : ?>
							<?php include __DIR__ . '/inc/order-card.php'; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<details class="board-past">
					<summary>Past orders (<?php echo count( $past ); ?>)</summary>
					<?php if ( empty( $past ) ) : ?>
						<p class="board-empty">Nothing finished yet.</p>
					<?php else : ?>
						<div class="board-list">
							<?php foreach ( $past as $order ) : ?>
								<?php include __DIR__ . '/inc/order-card.php'; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</details>

				<form method="post" id="board-bulk">
					<input type="hidden" name="sbc_board_action" value="remove_selected">
					<?php wp_nonce_field( 'sbc_board_status' ); ?>
					<div id="bulk-ids"></div>
				</form>
			<?php endif; ?>
		</div>
	</section>
</main>
<script>
(function () {
	var btn = document.getElementById('board-edit');
	if (!btn) return;
	btn.addEventListener('click', function () {
		document.body.classList.toggle('board-editing');
		btn.textContent = document.body.classList.contains('board-editing') ? 'Done editing' : 'Edit';
	});
	var del = document.getElementById('delete-selected');
	del.addEventListener('click', function () {
		var checked = document.querySelectorAll('.board-check input:checked');
		if (!checked.length) {
			alert('Select at least one order.');
			return;
		}
		if (!confirm('Cancel the selected orders?')) return;
		var box = document.getElementById('bulk-ids');
		box.innerHTML = '';
		checked.forEach(function (input) {
			var hidden = document.createElement('input');
			hidden.type = 'hidden';
			hidden.name = 'order_ids[]';
			hidden.value = input.value;
			box.appendChild(hidden);
		});
		document.getElementById('board-bulk').submit();
	});
})();
</script>
<?php
get_footer();
