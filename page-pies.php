<?php
/**
 * Template Name: Pies
 */
get_header();

$title          = 'Homemade Pies in Clearfield, Utah';
$intro          = 'Homemade pies for holidays, Sunday dinner, or a simple sweet finish. Tell Raquel the flavor and date you need it.';
$cta_label      = 'Order Pies Now';
$order_type     = 'pies';
$gallery_title  = 'Pie Gallery';
$gallery_intro  = 'A few of Raquel’s pies. Ask about flavors available this week.';
$album          = 'pies';

$details        = array(
	'Sprinkle Berry Cakes & Desserts in Clearfield bakes homemade pies for holidays, Sunday dinner, and simple sweet finishes. Tell Raquel the flavor and the date you need it, and she will confirm what is available.',
	'Pies are a good fit for Thanksgiving, Christmas, family dinners, and office gatherings. The bakery is at 540 E 1700 S Suite #101 in Clearfield, near Hill Air Force Base. Pickup is Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM.',
	'The bakery is closed Sunday and Monday. Call (801) 825-6702 or use the order form with the flavor, size, and date. Raquel will confirm the price and lead time before the pie is baked. A military discount is available upon request.',
	'If you are in Clearfield, Layton, Roy, Syracuse, or Ogden and need a pie for a holiday or dinner, order ahead so she can plan the bake.',
);

include get_template_directory() . '/inc/category-page.php';
get_footer();
