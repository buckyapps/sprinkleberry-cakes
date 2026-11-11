<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$maps = 'https://share.google/SR1xUsRwcMQeOmlZv';
?>
<style>
.contact{background:linear-gradient(135deg,#4a9d8c 0%,#6eb8a8 100%) !important;color:#fff !important;}
.contact .section-header h2,.contact .section-header p,.contact-info,.contact-info h3,.contact-info p,.contact-info a{color:#fff !important;}
.order-form{background:#f7c5d0 !important;color:#2c2a28 !important;}
.order-form h3,.form-group label{color:#2c2a28 !important;}
.form-group input,.form-group textarea,.form-group select{background:#fff !important;color:#2c2a28 !important;border:1px solid #e89aab !important;}
</style>
<section class="section contact" id="contact">
	<div class="container">
		<div class="section-header fade-up">
			<h2>Let’s Make Something Sweet</h2>
			<p>Ready to order a custom cake or just have a question? Reach out — Raquel would love to hear from you.</p>
		</div>

		<div class="contact-grid">
			<div class="contact-info fade-up">
				<h3>Visit or Call</h3>
				<p><a href="<?php echo esc_url( $maps ); ?>" target="_blank" rel="noopener" style="font-weight:700; text-decoration:underline;">540 E 1700 S Suite #101<br>Clearfield, UT 84015</a></p>
				<a href="tel:+18018256702">(801) 825-6702</a>
				<a href="mailto:Raoreggia@gmail.com">Raoreggia@gmail.com</a>

				<ul class="hours-list">
					<li><span>Tuesday – Friday</span> <span>10 AM – 6 PM</span></li>
					<li><span>Saturday</span> <span>10 AM – 4 PM</span></li>
					<li><span>Sunday & Monday</span> <span>Closed</span></li>
				</ul>
			</div>

			<div class="order-form fade-up">
				<h3>Request a Custom Order</h3>
				<?php if ( isset( $_GET['order'] ) && $_GET['order'] === 'success' ) : ?>
					<p class="berries-note">Thank you — Raquel has your request. She’ll follow up by email.</p>
				<?php endif; ?>
				<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="sprinkleberry_order">
					<?php wp_nonce_field( 'sprinkleberry_order', 'sprinkleberry_order_nonce' ); ?>

					<div class="form-group">
						<label for="order_name">Your Name</label>
						<input type="text" id="order_name" name="order_name" required>
					</div>
					<div class="form-group">
						<label for="order_email">Email</label>
						<input type="email" id="order_email" name="order_email" required>
					</div>
					<div class="form-group">
						<label for="order_phone">Phone</label>
						<input type="tel" id="order_phone" name="order_phone">
					</div>
					<div class="form-group">
						<label for="order_type">What are you ordering?</label>
						<select id="order_type" name="order_type">
							<?php
							$selected = isset( $_GET['order'] ) ? sanitize_text_field( wp_unslash( $_GET['order'] ) ) : '';
							$opts = array(
								'custom-cake'  => 'Artisan Cakes',
								'cupcakes'     => 'Cupcakes',
								'desserts'     => 'Desserts',
								'cheesecake'   => 'Cheesecakes',
								'pies'         => 'Pies',
								'sweet-treats' => 'Sweet Treats',
								'other'        => 'Other / Question',
							);
							foreach ( $opts as $val => $lab ) {
								printf(
									'<option value="%s"%s>%s</option>',
									esc_attr( $val ),
									selected( $selected, $val, false ),
									esc_html( $lab )
								);
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="order_message">Details / Occasion</label>
						<textarea id="order_message" name="order_message" placeholder="Date needed, number of servings, theme, flavors..."></textarea>
					</div>
					<button type="submit" class="btn btn-primary" style="width:100%;">Send Request</button>
				</form>
			</div>
		</div>
	</div>
</section>
