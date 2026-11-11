<?php
/**
 * Template Name: Other Sweet Treats
 */

get_header();

$title          = 'Cake Pops & Sweet Treats in Clearfield, Utah';
$intro          = 'Little extras that make a celebration feel complete — chocolate-covered strawberries, cake pops, pastries, and other handmade delicacies from Raquel’s kitchen.';
$cta_label      = 'Order My Sweet Treats Now';
$order_type     = 'sweet-treats';
$gallery_title  = 'Treats Gallery';
$gallery_intro  = 'Ask about seasonal specialties, Brazilian-inspired desserts, and party trays.';
$album          = 'sweet-treats';

$details        = array(
	'Sprinkle Berry in Clearfield makes small handmade treats — chocolate-covered strawberries, cake pops, pastries, and other little delicacies for parties and gifts. These extras work well on a dessert table or as a sweet box to share.',
	'Tell Raquel the occasion, how many pieces you need, and the date. Popular requests include chocolate-covered strawberries, cake pops, and seasonal pastries. Pickup is from 540 E 1700 S Suite #101 in Clearfield, Utah.',
	'Hours are Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM. The bakery is closed Sunday and Monday. Call (801) 825-6702 or send an order request so she can confirm what is available, the price, and the lead time. A military discount is available upon request.',
	'Serving Clearfield, Layton, Roy, Syracuse, and Ogden. Browse the treats gallery, then order the extras you want for your celebration.',
);

include get_template_directory() . '/inc/category-page.php';

get_footer();
