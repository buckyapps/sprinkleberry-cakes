<?php
/**
 * Shared layout for category gallery pages.
 * Expected vars: $title, $intro, $cta_label, $order_type, $gallery_title, $gallery_intro, $album
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_url = home_url( '/about/?order=' . rawurlencode( $order_type ) . '#contact' );
$images  = ! empty( $album ) ? sprinkleberry_album_photos( $album ) : array();
?>

<main id="main">

	<section class="page-hero">
		<div class="container page-hero-inner fade-up">
			<p class="page-kicker">Sprinkle Berry Cakes &amp; Desserts</p>
			<h1><?php echo esc_html( $title ); ?></h1>
			<p><?php echo esc_html( $intro ); ?></p>
			<a class="btn btn-primary" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
		</div>
	</section>

	<?php if ( ! empty( $details ) && is_array( $details ) ) : ?>
	<section class="section category-details">
		<div class="container fade-up">
			<?php foreach ( $details as $paragraph ) : ?>
				<p><?php echo esc_html( $paragraph ); ?></p>
			<?php endforeach; ?>
		</div>
	</section>
	<?php endif; ?>

	<section class="section gallery">
		<div class="container">
			<div class="section-header fade-up">
				<h2><?php echo esc_html( $gallery_title ); ?></h2>
				<p><?php echo esc_html( $gallery_intro ); ?></p>
			</div>

			<?php if ( ! empty( $images ) ) : ?>
			<div class="gallery-grid">
				<?php foreach ( $images as $image ) : ?>
					<div class="gallery-item fade-up">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
					</div>
				<?php endforeach; ?>
			</div>
			<?php else : ?>
			<p class="gallery-empty fade-up">Raquel is adding more photos here. Send a request or call the bakery if you want to know what is available this week.</p>
			<?php endif; ?>

			<div class="category-cta fade-up">
				<a class="btn btn-primary" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
			</div>
		</div>
	</section>

</main>
