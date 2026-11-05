<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$google_reviews_url = 'https://share.google/SR1xUsRwcMQeOmlZv';
$berry_ok = isset( $_GET['berry'] ) && $_GET['berry'] === '1';
$berry_dup = isset( $_GET['berry'] ) && $_GET['berry'] === 'exists';
?>

	<section class="section reviews" id="reviews">
		<div class="container">
			<div class="section-header fade-up">
				<h2>Check out what people are saying</h2>
			</div>
			<div class="reviews-grid">
				<article class="review-card fade-up">
					<p class="review-stars">★★★★★</p>
					<p class="review-text">“I just wanted a sweet treat and stopped by here and they had such cute options that all looked amazing. My husband and I each got a cannoli, which she filled upon order, and tried the Biscoff cheesecake and the tres leches. All 3 were wins!”</p>
					<p class="review-name">Olivia O. <span>Google</span></p>
				</article>
				<article class="review-card fade-up">
					<p class="review-stars">★★★★★</p>
					<p class="review-text">“Raquel was absolutely wonderful to work with. I wanted to surprise someone with a cake but I am out of state. She responded right away, helped with the design and flavor, and the cake was gorgeous. The recipient was blown away.”</p>
					<p class="review-name">Wendy <span>Google</span></p>
				</article>
				<article class="review-card fade-up">
					<p class="review-stars">★★★★★</p>
					<p class="review-text">“The service here is so friendly and fast. I love their variety and the quality of each item is great. Huge fan of the cheesecake and the cake pops!”</p>
					<p class="review-name">Gabrielle M. <span>Google</span></p>
				</article>
			</div>
			<p class="reviews-more fade-up">
				<a class="btn btn-teal" href="<?php echo esc_url( $google_reviews_url ); ?>" target="_blank" rel="noopener">Read more Google reviews</a>
			</p>
		</div>
	</section>
