<?php
/**
 * Template Name: Other Sweet Treats
 */

get_header();

$title          = 'Sweet Treats';
$intro          = 'Little extras that make a celebration feel complete — chocolate-covered strawberries, cake pops, pastries, and other handmade delicacies from Raquel’s kitchen.';
$cta_label      = 'Order My Sweet Treats Now';
$order_type     = 'sweet-treats';
$gallery_title  = 'Treats Gallery';
$gallery_intro  = 'Ask about seasonal specialties, Brazilian-inspired desserts, and party trays.';
$album          = 'sweet-treats';

include get_template_directory() . '/inc/category-page.php';

get_footer();
