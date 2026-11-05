<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$ig_url = 'https://www.instagram.com/sprinkleberrycakes/';
$fb_url = 'https://www.facebook.com/sprinkleberry/';
?>
<section class="section instagram" id="instagram">
	<div class="container">
		<div class="section-header fade-up">
			<h2>Follow the bakery</h2>
			<p>See Raquel’s latest cakes and treats on Instagram and Facebook</p>
		</div>

		<div class="instagram-embed-wrap fade-up">
			<blockquote
				class="instagram-media"
				data-instgrm-permalink="<?php echo esc_url( $ig_url ); ?>"
				data-instgrm-version="14"
				style="background:#FFF; border:0; border-radius:12px; margin:0 auto; max-width:540px; min-width:280px; width:100%;">
				<a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener">@sprinkleberrycakes on Instagram</a>
			</blockquote>
		</div>

		<p class="instagram-cta fade-up">
			<a class="btn btn-primary" href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener">Instagram</a>
			<a class="btn btn-teal" href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener">Facebook</a>
		</p>
	</div>
</section>
