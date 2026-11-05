<?php
/**
 * Template Name: Parfaits
 */
get_header();

$title          = 'Parfaits';
$intro          = 'Layered parfaits and individual cups — pretty, portable, and easy to share at parties or as a grab-and-go treat.';
$cta_label      = 'Order Parfaits Now';
$order_type     = 'parfaits';
$gallery_title  = 'Parfait Gallery';
$gallery_intro  = 'Parfait photos will be added here. Use the button below to request flavors and quantities.';
$images         = array();

include get_template_directory() . '/inc/category-page.php';
get_footer();
