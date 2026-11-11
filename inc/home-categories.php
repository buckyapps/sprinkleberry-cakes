<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$img = get_template_directory_uri() . '/assets/images/';
$cats = array(
	array(
		'slug' => 'artisan-cakes',
		'title' => 'Artisan Cakes',
		'text'  => 'Custom handmade cakes designed around your occasion — from kids’ birthdays to weddings — with flavors and details chosen just for you.',
		'tag'   => 'View Cake Gallery',
		'img'   => 'cake-andrew.jpg?v=131',
		'alt'   => 'Custom dragon-themed birthday cake from Sprinkle Berry in Clearfield, UT',
	),
	array(
		'slug' => 'cupcakes',
		'title' => 'Cupcakes',
		'text'  => 'Made-to-order cupcakes in the themes, flavors, and colors you want — perfect for parties, dessert tables, or a sweet box to share.',
		'tag'   => 'View Cupcake Gallery',
		'img'   => 'cupcakes-tray.jpg?v=132',
		'alt'   => 'Tray of green and purple custom cupcakes from Sprinkle Berry in Clearfield, UT',
	),
	array(
		'slug' => 'desserts',
		'title' => 'Desserts',
		'text'  => 'Tres leches, Brazilian-inspired sweets, and other plated desserts made fresh for gatherings and everyday treats.',
		'tag'   => 'View Dessert Gallery',
		'img'   => 'dessert-tart.jpg?v=155',
		'alt'   => 'Fresh fruit tart from Sprinkle Berry dessert shop in Clearfield, UT',
	),
	array(
		'slug' => 'cheesecakes',
		'title' => 'Cheesecakes',
		'text'  => 'Creamy cheesecakes by the slice or whole — including favorites like Biscoff and caramel.',
		'tag'   => 'View Cheesecake Gallery',
		'img'   => 'cheesecake-biscoff.jpg?v=157',
		'alt'   => 'Biscoff cookie cheesecake slice, handmade in Clearfield, UT',
	),
	array(
		'slug' => 'pies',
		'title' => 'Pies',
		'text'  => 'Homemade pies for holidays, Sunday dinner, or a simple sweet finish.',
		'tag'   => 'View Pie Gallery',
		'img'   => 'pie-lemon.jpg?v=156',
		'alt'   => 'Homemade lemon cream pie from Sprinkle Berry in Clearfield, UT',
	),
	array(
		'slug' => 'sweet-treats',
		'title' => 'Sweet Treats',
		'text'  => 'Cake pops, chocolate-covered strawberries, pastries, and other little handmade extras from Raquel’s kitchen.',
		'tag'   => 'View Treats Gallery',
		'img'   => 'treats-strawberries.jpg?v=158',
		'alt'   => 'Box of chocolate-covered strawberries from Sprinkle Berry in Clearfield, UT',
	),
);
?>
<section class="section featured" id="cakes">
	<div class="container">
		<div class="section-header fade-up">
			<h2>Cheesecake, custom cakes and desserts made by hand in Clearfield</h2>
			<p>Pick a category to see photos and place an order with Raquel.</p>
		</div>
	</div>
	<div class="container">
		<div class="cake-grid">
			<?php foreach ( $cats as $i => $cat ) :
				$slide = ( $i % 2 === 0 ) ? 'slide-left' : 'slide-right';
				?>
				<a class="cake-card <?php echo $slide; ?>" href="<?php echo esc_url( home_url( '/' . $cat['slug'] . '/' ) ); ?>">
					<h2><?php echo esc_html( $cat['title'] ); ?></h2>
					<div class="card-image">
						<img src="<?php echo esc_url( $img . $cat['img'] ); ?>" alt="<?php echo esc_attr( $cat['alt'] ); ?>">
					</div>
					<div class="cake-card-content">
						<p><?php echo esc_html( $cat['text'] ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
