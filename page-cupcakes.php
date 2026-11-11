<?php
/**
 * Template Name: Cupcakes
 */
get_header();

$title         = 'Custom Cupcakes in Clearfield, Utah';
$intro         = 'Made-to-order cupcakes in the themes, flavors, and colors you want. Perfect for parties, dessert tables, or a box of something sweet to share.';
$cta_label     = 'Order My Cupcakes Now';
$order_type    = 'cupcakes';
$gallery_title = 'Cupcake Gallery';
$gallery_intro = 'From classic swirls to themed parties — tell Raquel the occasion and she’ll match the look and flavor.';
$album         = 'cupcakes';

$details        = array(
	'Sprinkle Berry in Clearfield makes cupcakes to order for parties, dessert tables, office treats, and sweet boxes to share. Choose a theme, colors, and flavors, and Raquel will match the look to the occasion.',
	'Cupcakes work well for birthdays, baby showers, school parties, and small gatherings when a full cake is more than you need. Tell her how many dozen you want, the date, and any theme or dietary notes. The bakery is at 540 E 1700 S Suite #101 in Clearfield, Utah.',
	'Pickup is Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM. Sunday and Monday are closed. Call (801) 825-6702 or send an order request with the date and quantity so she can confirm flavors, price, and lead time. A military discount is available upon request.',
	'Serving Clearfield, Layton, Roy, Syracuse, and Ogden. Browse the gallery for ideas, then order your cupcakes with the date you need them.',
);

include get_template_directory() . '/inc/category-page.php';
get_footer();
