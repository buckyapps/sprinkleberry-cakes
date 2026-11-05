<?php
/**
 * Template Name: Desserts
 */
get_header();

$title          = 'Desserts';
$intro          = 'Fresh desserts from Raquel’s kitchen — tres leches, Brazilian-inspired sweets, and plated treats for parties or a simple after-dinner bite.';
$cta_label      = 'Order Desserts Now';
$order_type     = 'desserts';
$gallery_title  = 'Dessert Gallery';
$gallery_intro  = 'Tres leches, Brazilian-inspired sweets, and plated desserts made for gatherings or a simple after-dinner bite.';
$album          = 'desserts';
$details        = array(
	'Raquel’s dessert case in Clearfield covers more than custom cakes. Tres leches, Brazilian-inspired sweets, and plated desserts are made for parties, family dinners, and everyday treats. If you want something that feels a little different from a standard sheet cake, this is the place to start.',
	'Tell her the occasion, how many people you are feeding, and whether you want a classic flavor or something with a Brazilian touch. She can talk through options for a dessert table, a plated finish after dinner, or a simple pickup order from the bakery.',
	'Sprinkle Berry is at 540 E 1700 S Suite #101 in Clearfield, Utah. Pickup is Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM. The bakery is closed Sunday and Monday. Call (801) 825-6702 or use the order form with the date, serving size, and any flavor notes.',
	'Desserts are made fresh, so order ahead when you can. Raquel will confirm what is available, the lead time, and the price before the order is locked in. A military discount is available upon request.',
);

include get_template_directory() . '/inc/category-page.php';
get_footer();
