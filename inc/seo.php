<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_seo_map() {
	return array(
		'home' => array(
			'title' => 'Cheesecake, Custom Cakes & Desserts in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Custom cakes, cheesecake, cupcakes, pies, and Brazilian-inspired desserts from Raquel in Clearfield, Utah. Order for birthdays, weddings, and parties.',
		),
		'artisan-cakes' => array(
			'title' => 'Custom Cakes in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Handmade custom cakes in Clearfield for birthdays, weddings, and baby showers. Share a theme and date and Raquel will design one just for you.',
		),
		'cupcakes' => array(
			'title' => 'Cupcakes in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Made-to-order cupcakes in Clearfield, Utah. Choose themes, flavors, and colors for parties, dessert tables, and sweet boxes.',
		),
		'desserts' => array(
			'title' => 'Desserts in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Tres leches, Brazilian-inspired sweets, and plated desserts in Clearfield. Order for gatherings or a simple after-dinner treat from Raquel.',
		),
		'cheesecakes' => array(
			'title' => 'Cheesecake in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Creamy cheesecakes by the slice or whole cake in Clearfield, including Biscoff and caramel. Ask Raquel about this week’s flavors.',
		),
		'pies' => array(
			'title' => 'Pies in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Homemade pies in Clearfield for holidays, Sunday dinner, or a simple sweet finish. Tell Raquel the flavor and the date you need it.',
		),
		'sweet-treats' => array(
			'title' => 'Sweet Treats in Clearfield, UT | Sprinkle Berry',
			'desc'  => 'Cake pops, chocolate-covered strawberries, and little handmade treats from Raquel’s kitchen in Clearfield, Utah.',
		),
		'about' => array(
			'title' => 'About Raquel | Sprinkle Berry Cakes Clearfield',
			'desc'  => 'Meet Raquel Oreggia, the baker behind Sprinkle Berry Cakes & Desserts in Clearfield, Utah. Custom cakes, Brazilian flavors, and a military discount.',
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
	$image = get_template_directory_uri() . '/assets/images/cake-floral.jpg';
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
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
		'name'        => 'Sprinkle Berry Cakes & Desserts',
		'url'         => home_url( '/' ),
		'image'       => get_template_directory_uri() . '/assets/images/logo-header-v2.png',
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
			'latitude'  => 41.1107,
			'longitude' => -112.026,
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
			'Clearfield, UT',
			'Layton, UT',
			'Roy, UT',
			'Syracuse, UT',
			'Ogden, UT',
			'Davis County, UT',
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
