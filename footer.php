<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div class="footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
					Sprinkle <span>Berry</span> Cakes &amp; Desserts
				</a>
				<p>Custom cakes & desserts made with love in Clearfield, Utah. Brazilian flair meets Utah celebrations.</p>
			</div>

			<div class="footer-links">
				<h4>Visit Us</h4>
				<ul>
					<li><a href="https://maps.google.com/maps/place//data=!4m2!3m1!1s0x8753032800c53519:0x54709fbafa1cbf89?entry=s&sa=X&ved=2ahUKEwilkPHwoLqWAxVSH0QIHW8TFiEQ4kB6BAgVEAA&hl=en" target="_blank" rel="noopener" style="font-weight:700; text-decoration:underline;">540 E 1700 S Suite #101</a></li>
					<li><a href="https://maps.google.com/maps/place//data=!4m2!3m1!1s0x8753032800c53519:0x54709fbafa1cbf89?entry=s&sa=X&ved=2ahUKEwilkPHwoLqWAxVSH0QIHW8TFiEQ4kB6BAgVEAA&hl=en" target="_blank" rel="noopener" style="font-weight:700; text-decoration:underline;">Clearfield, UT 84015</a></li>
					<li><a href="tel:+18018256702">(801) 825-6702</a></li>
					<li><a href="mailto:Raoreggia@gmail.com">Raoreggia@gmail.com</a></li>
					<li><a href="https://www.instagram.com/sprinkleberrycakes/" target="_blank" rel="noopener">Instagram @sprinkleberrycakes</a></li>
					<li><a href="https://www.facebook.com/sprinkleberry/" target="_blank" rel="noopener">Facebook</a></li>
				</ul>
			</div>

			<div class="footer-links">
				<h4>Shop</h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/artisan-cakes/' ) ); ?>">Artisan Cakes</a></li>
					<li><a href="<?php echo esc_url( home_url( '/cupcakes/' ) ); ?>">Cupcakes</a></li>
					<li><a href="<?php echo esc_url( home_url( '/desserts/' ) ); ?>">Desserts</a></li>
					<li><a href="<?php echo esc_url( home_url( '/cheesecakes/' ) ); ?>">Cheesecakes</a></li>
					<li><a href="<?php echo esc_url( home_url( '/pies/' ) ); ?>">Pies</a></li>
					<li><a href="<?php echo esc_url( home_url( '/sweet-treats/' ) ); ?>">Sweet Treats</a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/#contact' ) ); ?>">Order Now</a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
					<li><a href="<?php echo esc_url( home_url( '/#berries' ) ); ?>">Join Sprinkle Berries</a></li>
				</ul>
			</div>

			<div class="footer-links">
				<h4>Hours</h4>
				<ul>
					<li>Tue – Fri: 10 AM – 6 PM</li>
					<li>Saturday: 10 AM – 4 PM</li>
					<li>Sunday & Monday: Closed</li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo date( 'Y' ); ?> Sprinkle Berry Cakes &amp; Desserts. All rights reserved. Made with love by Raquel Oreggia.</p>
		</div>
	</div>
</footer>

<div class="lightbox" id="lightbox" hidden>
	<button type="button" class="lightbox-close" id="lightbox-close" aria-label="Close photo">&times;</button>
	<div class="lightbox-stage" id="lightbox-stage">
		<img id="lightbox-img" alt="">
	</div>
	<p class="lightbox-hint">Tap the photo to zoom · tap outside or X to close</p>
</div>

<?php wp_footer(); ?>
</body>
</html>
