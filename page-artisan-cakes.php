<?php
/**
 * Template Name: Artisan Cakes
 */
get_header();

$title         = 'Artisan Cakes';
$intro         = 'Handcrafted cakes designed around your celebration — birthdays, weddings, baby showers, and the moments in between. Every cake is made to order, from the flavor inside to the last piped flower.';
$cta_label     = 'Order My Custom Cake Now';
$order_type    = 'custom-cake';
$gallery_title = 'Cake Gallery';
$gallery_intro = 'A few of Raquel’s custom cakes. Share a theme, colors, and date, and she’ll design one just for you.';
$album         = 'artisan-cakes';

include get_template_directory() . '/inc/category-page.php';
get_footer();
