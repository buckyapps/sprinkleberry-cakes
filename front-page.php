<?php
/**
 * Homepage — categories, reviews, email list
 */
get_header();
?>

<main id="main">

	<section class="hero" id="home">
		<div class="hero-video-wrap">
			<video class="hero-video" autoplay muted loop playsinline poster="<?php echo get_template_directory_uri(); ?>/assets/images/hero-cake.png">
				<source src="<?php echo get_template_directory_uri(); ?>/assets/video/cake-decorating.mp4" type="video/mp4">
			</video>
			<div class="hero-overlay"></div>
		</div>
		<div class="container hero-content-wrap">
			<div class="hero-content fade-up">
				<h1 class="screen-reader">Cheesecake, Custom Cakes & Desserts in Clearfield, Utah</h1>
				<p class="hero-display" aria-hidden="true">
					<span class="hero-line hero-cakes">Artisan Cakes</span>
					<span class="hero-line hero-desserts">Desserts <em>&amp;</em></span>
					<span class="hero-line hero-treats">Sweet Treats</span>
				</p>
				<p>Handmade custom cakes, cupcakes, and Brazilian-inspired desserts for birthdays, weddings, and every sweet celebration in Northern Utah.</p>
				<div class="hero-buttons">
					<a href="<?php echo esc_url( home_url( '/about/#contact' ) ); ?>" class="btn btn-primary">Order Now</a>
					<a href="#cakes" class="btn btn-outline">Browse Treats</a>
				</div>
			</div>
		</div>
	</section>

	<?php include get_template_directory() . '/inc/home-categories.php'; ?>

	<?php include get_template_directory() . '/inc/reviews-and-berries.php'; ?>

	<section class="section berries" id="berries">
		<div class="container berries-inner fade-up">
			<h2>Become one of our Sprinkle Berries!</h2>
			<p>Get the latest bakery news, seasonal flavors, and special promotions from Raquel — straight to your inbox.</p>
			<?php if ( ! empty( $berry_ok ) ) : ?>
				<p class="berries-note">You’re in! Welcome to the Sprinkle Berries list.</p>
			<?php elseif ( ! empty( $berry_dup ) ) : ?>
				<p class="berries-note">That email is already on the list. Thank you!</p>
			<?php endif; ?>
			<form class="berries-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="sprinkleberry_subscribe">
				<?php wp_nonce_field( 'sprinkleberry_subscribe', 'sprinkleberry_subscribe_nonce' ); ?>
				<label class="screen-reader" for="berry_email">Email address</label>
				<input type="email" id="berry_email" name="berry_email" placeholder="Your email address" required>
				<button type="submit" class="btn btn-primary">Join the bakery</button>
			</form>
		</div>
	</section>


	<section class="section faq" id="faq">
		<div class="container">
			<div class="section-header fade-up">
				<h2>Bakery questions</h2>
				<p>Hours, orders, and how to reach Raquel in Clearfield.</p>
			</div>
			<div class="faq-list">
				<?php foreach ( sprinkleberry_faq_items() as $item ) : ?>
				<details class="faq-item fade-up">
					<summary><?php echo esc_html( $item['q'] ); ?></summary>
					<p><?php echo esc_html( $item['a'] ); ?></p>
				</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php include get_template_directory() . '/inc/instagram-feed.php'; ?>

</main>

<?php get_footer(); ?>
