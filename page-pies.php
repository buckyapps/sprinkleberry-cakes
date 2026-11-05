<?php
/**
 * Template Name: Pies
 */
get_header();

$title          = 'Pies';
$intro          = 'Homemade pies for holidays, Sunday dinner, or a simple sweet finish. Tell Raquel the flavor and date you need it.';
$cta_label      = 'Order Pies Now';
$order_type     = 'pies';
$gallery_title  = 'Pie Gallery';
$gallery_intro  = 'A few of Raquel’s pies. Ask about flavors available this week.';
$album          = 'pies';

include get_template_directory() . '/inc/category-page.php';
get_footer();
