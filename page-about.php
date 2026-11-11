<?php
/**
 * Template Name: About
 */
get_header();
?>

<main id="main">
	<section class="page-hero">
		<div class="container page-hero-inner fade-up">
			<p class="page-kicker">Sprinkle Berry Cakes &amp; Desserts</p>
			<h1>Meet Raquel, Clearfield's Custom Cake Baker</h1>
			<p>The baker behind the custom cakes, cupcakes, and sweet treats in Clearfield, Utah.</p>
		</div>
	</section>

	<section class="section about" id="about">
		<div class="container about-grid">
			<div class="about-image fade-up">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/chocolate-cupcakes.png" alt="Chocolate cupcakes with colorful candy decorations, made by Raquel in Clearfield, UT">
			</div>
			<div class="about-content fade-up">
				<h2>A bakery built with love</h2>
				<p>Originally from Brazil, Raquel Oreggia brought her passion for baking and decorating to Utah nearly two decades ago. She specializes in custom cakes that are as beautiful as they are delicious.</p>
				<p>Her favorite creations are kids’ cakes — “the look on their face when they see it is priceless.” She also loves incorporating Brazilian flavors when customers are open to trying something new.</p>
				<p>Located near Hill Air Force Base, Sprinkle Berry Cakes &amp; Desserts proudly offers a military discount upon request.</p>

				<div class="about-stats">
					<div class="stat">
						<p class="stat-value">98%</p>
						<span>Recommend</span>
					</div>
					<div class="stat">
						<p class="stat-value">Custom</p>
						<span>Every Cake</span>
					</div>
					<div class="stat">
						<p class="stat-value">❤️</p>
						<span>Made with Love</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include get_template_directory() . '/inc/contact-block.php'; ?>
</main>

<?php get_footer(); ?>
