<?php
/**
 * Template Name: Artisan Cakes
 */
get_header();

$title         = 'Custom Cakes in Clearfield, Utah';
$intro         = 'Handcrafted cakes designed around your celebration — birthdays, weddings, baby showers, and the moments in between. Every cake is made to order, from the flavor inside to the last piped flower.';
$cta_label     = 'Order My Custom Cake Now';
$order_type    = 'custom-cake';
$gallery_title = 'Cake Gallery';
$gallery_intro = 'A few of Raquel’s custom cakes. Share a theme, colors, and date, and she’ll design one just for you.';
$album         = 'artisan-cakes';

$details        = array(
	'Sprinkle Berry Cakes & Desserts in Clearfield makes artisan cakes by hand for birthdays, weddings, baby showers, and other celebrations across Davis County. Raquel designs each cake around the occasion, from a simple floral finish to a themed kids’ cake, with flavors and colors chosen just for you.',
	'Custom cakes are made to order. Share the date, how many people you are serving, a theme or colors, and any flavor notes. Popular requests include birthday cakes, wedding cakes, baby shower cakes, and one-of-a-kind designs. Pickup is from the bakery at 540 E 1700 S Suite #101 in Clearfield, near Hill Air Force Base.',
	'Hours are Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM. The bakery is closed Sunday and Monday. Call (801) 825-6702 or use the order form so Raquel can confirm the design, price, and lead time before anything is baked. A military discount is available upon request.',
	'If you are in Clearfield, Layton, Roy, Syracuse, or Ogden and need a custom cake, start with the gallery and then send a request. Raquel will reply with what is possible for your date and help lock in the details.',
);

include get_template_directory() . '/inc/category-page.php';
get_footer();
