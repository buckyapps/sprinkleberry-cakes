<?php
/**
 * Template Name: Cupcakes
 */
get_header();

$title         = 'Cupcakes';
$intro         = 'Made-to-order cupcakes in the themes, flavors, and colors you want. Perfect for parties, dessert tables, or a box of something sweet to share.';
$cta_label     = 'Order My Cupcakes Now';
$order_type    = 'cupcakes';
$gallery_title = 'Cupcake Gallery';
$gallery_intro = 'From classic swirls to themed parties — tell Raquel the occasion and she’ll match the look and flavor.';
$album         = 'cupcakes';

include get_template_directory() . '/inc/category-page.php';
get_footer();
