<?php
/**
 * Template Name: Cheesecakes
 */
get_header();

$title          = 'Cheesecakes';
$intro          = 'Creamy cheesecakes by the slice or whole cake — including favorites like Biscoff and caramel. Ask about flavors available this week.';
$cta_label      = 'Order Cheesecake Now';
$order_type     = 'cheesecake';
$gallery_title  = 'Cheesecake Gallery';
$gallery_intro  = 'A few of Raquel’s cheesecakes. Ask about slices or a whole cake for your next gathering.';
$album          = 'cheesecakes';
$details        = array(
	'Sprinkle Berry Cakes & Desserts in Clearfield makes creamy cheesecakes by the slice or as a whole cake. Favorites include Biscoff cookie cheesecake and caramel. Raquel can also talk through other flavors for a party, office tray, or a simple weekend dessert.',
	'Whole cheesecakes work well for birthdays, family dinners, and holiday tables. Slices are a good fit if you are stopping by the bakery or need a smaller order. Tell her how many people you are serving and whether you want it plain, topped, or matched to a theme.',
	'The bakery is at 540 E 1700 S Suite #101 in Clearfield, near Hill Air Force Base. Hours are Tuesday through Friday, 10 AM to 6 PM, and Saturday 10 AM to 4 PM. Sunday and Monday are closed. Call (801) 825-6702 or send an order request with the date you need it, the size, and any flavor notes.',
	'Cheesecake is made to order, so give Raquel a little lead time. She will confirm the flavor, pickup day, and price before anything is baked. A military discount is available upon request.',
);

include get_template_directory() . '/inc/category-page.php';
get_footer();
