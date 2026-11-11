<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_seo_map() {
	return array(
		'home' => array(
			'title' => 'Cheesecake, Custom Cakes & Desserts in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Handmade cheesecakes, custom cakes, cupcakes, pies and Brazilian-inspired desserts in Clearfield, Utah. Open Tue-Sat. Call (801) 825-6702.',
		),
		'artisan-cakes' => array(
			'title' => 'Custom Cakes in Clearfield & Davis County, UT | Sprinkle Berry',
			'desc'  => 'Custom birthday, wedding and shower cakes designed around your theme in Clearfield, UT. Kids cakes are a specialty. Send your date and ideas.',
		),
		'cupcakes' => array(
			'title' => 'Custom Cupcakes in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Made-to-order cupcakes by the dozen for birthdays, school parties and dessert tables in Clearfield, Utah. Choose flavors, colors and themes.',
		),
		'desserts' => array(
			'title' => 'Dessert Shop in Clearfield, UT | Tres Leches & More',
			'desc'  => 'Tres leches, cannoli and Brazilian-inspired desserts from Sprinkle Berry, a Clearfield, Utah dessert shop. Order for parties.',
		),
		'cheesecakes' => array(
			'title' => 'Cheesecake in Clearfield, UT: Biscoff, Caramel & More',
			'desc'  => 'Handmade cheesecake by the slice or whole in Clearfield, UT. Biscoff, caramel and rotating flavors. Ask what is fresh and order from Sprinkle Berry.',
		),
		'pies' => array(
			'title' => 'Homemade Pies in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Order homemade lemon cream and other pies in Clearfield, Utah for holidays and everyday. Pickup at Sprinkle Berry.',
		),
		'sweet-treats' => array(
			'title' => 'Cake Pops & Chocolate Strawberries in Clearfield, UT',
			'desc'  => 'Handmade cake pops, chocolate-covered strawberries and sweet treats for gifts and parties in Clearfield, Utah. Order ahead from Sprinkle Berry.',
		),
		'about' => array(
			'title' => 'About Raquel | Clearfield Bakery | Sprinkle Berry',
			'desc'  => 'Meet Raquel Oreggia, the Brazilian-born baker behind Sprinkle Berry in Clearfield, Utah, near Hill Air Force Base. Military discount on request.',
		),
	);
}

function sprinkleberry_faq_items() {
	return array(
		array(
			'q' => 'Where is Sprinkle Berry Cakes located?',
			'a' => 'Sprinkle Berry Cakes & Desserts is at 540 E 1700 S Suite #101 in Clearfield, Utah 84015, near Hill Air Force Base.',
		),
		array(
			'q' => 'What are the bakery hours?',
			'a' => 'Tuesday through Friday, 10 AM to 6 PM. Saturday, 10 AM to 4 PM. Closed Sunday and Monday.',
		),
		array(
			'q' => 'Do you take custom cake orders?',
			'a' => 'Yes. Custom cakes, cupcakes, cheesecakes, pies, and sweet treats are made to order. Share the date, occasion, and flavor notes and Raquel will confirm the price and lead time.',
		),
		array(
			'q' => 'Do you offer a military discount?',
			'a' => 'Yes. A military discount is available upon request. Mention it when you call or send an order request.',
		),
		array(
			'q' => 'How do I place an order?',
			'a' => 'Use the order form on the About page or call (801) 825-6702. Raquel will email you to confirm the details before the order is locked in.',
		),
	);
}

function sprinkleberry_current_seo() {
	$map = sprinkleberry_seo_map();
	if ( is_front_page() ) {
		return $map['home'];
	}
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $map[ $slug ] ) ) {
			return $map[ $slug ];
		}
	}
	return $map['home'];
}

function sprinkleberry_document_title( $parts ) {
	$seo = sprinkleberry_current_seo();
	if ( ! empty( $seo['title'] ) ) {
		$parts['title'] = $seo['title'];
		unset( $parts['site'] );
		unset( $parts['tagline'] );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'sprinkleberry_document_title' );

function sprinkleberry_document_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'sprinkleberry_document_title_separator' );

function sprinkleberry_meta_tags() {
	$seo   = sprinkleberry_current_seo();
	$desc  = $seo['desc'];
	$url   = is_front_page() ? home_url( '/' ) : get_permalink();
	$image = get_template_directory_uri() . '/assets/images/cheesecake-biscoff.jpg';
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( is_page( 'parfaits' ) ) {
		echo '<meta name="robots" content="noindex,follow">' . "\n";
	}
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $seo['title'] ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="Sprinkle Berry Cakes & Desserts">' . "\n";
	echo '<meta property="og:locale" content="en_US">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $seo['title'] ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
}
add_action( 'wp_head', 'sprinkleberry_meta_tags', 1 );

function sprinkleberry_bakery_schema() {
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => array( 'Bakery', 'LocalBusiness' ),
		'@id'         => home_url( '/#bakery' ),
		'name'        => 'Sprinkle Berry Cakes & Desserts',
		'alternateName' => 'Sprinkle Berry by Raquel',
		'url'         => home_url( '/' ),
		'logo'        => get_template_directory_uri() . '/assets/images/logo-header-v2.png',
		'image'       => get_template_directory_uri() . '/assets/images/cheesecake-biscoff.jpg',
		'description' => 'Handmade cheesecakes, custom cakes, cupcakes, pies and Brazilian-inspired desserts in Clearfield, Utah.',
		'servesCuisine' => array( 'Desserts', 'Cakes', 'Cheesecake', 'Brazilian' ),
		'founder'     => array( '@type' => 'Person', 'name' => 'Raquel Oreggia' ),
		'telephone'   => '+18018256702',
		'email'       => 'Raoreggia@gmail.com',
		'priceRange'  => '$$',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '540 E 1700 S Suite #101',
			'addressLocality' => 'Clearfield',
			'addressRegion'   => 'UT',
			'postalCode'      => '84015',
			'addressCountry'  => 'US',
		),
		'geo'         => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => 41.08857,
			'longitude' => -112.015641,
		),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '10:00',
				'closes'    => '18:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '10:00',
				'closes'    => '16:00',
			),
		),
		'areaServed'  => array(
			array( '@type' => 'City', 'name' => 'Clearfield' ),
			array( '@type' => 'City', 'name' => 'Layton' ),
			array( '@type' => 'City', 'name' => 'Syracuse' ),
			array( '@type' => 'City', 'name' => 'Clinton' ),
			array( '@type' => 'City', 'name' => 'Roy' ),
		),
		'sameAs'      => array(
			'https://www.instagram.com/sprinkleberrycakes/',
			'https://www.facebook.com/sprinkleberry/',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

	if ( is_front_page() ) {
		$faq = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array(),
		);
		foreach ( sprinkleberry_faq_items() as $item ) {
			$faq['mainEntity'][] = array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['a'],
				),
			);
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}

	if ( ! is_front_page() && is_page() ) {
		$crumbs = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => 'Home',
					'item'     => home_url( '/' ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => get_the_title(),
					'item'     => get_permalink(),
				),
			),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $crumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'sprinkleberry_bakery_schema', 2 );
