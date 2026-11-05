<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
	<div class="container header-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header-v2.png?v=120" alt="Sprinkle Berry Cakes & Desserts by Raquel – Artisan" class="logo-img">
		</a>

		<button class="menu-toggle" id="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="site-menu">
			<span class="menu-bar"></span>
			<span class="menu-bar"></span>
			<span class="menu-bar"></span>
		</button>

		<div class="menu-overlay" id="menu-overlay" hidden></div>

		<nav class="main-nav" id="site-menu" aria-label="Primary">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo is_front_page() ? 'active' : ''; ?>">Home</a></li>
				<li><a href="<?php echo esc_url( home_url( '/artisan-cakes/' ) ); ?>" class="<?php echo is_page( 'artisan-cakes' ) ? 'active' : ''; ?>">Artisan Cakes</a></li>
				<li><a href="<?php echo esc_url( home_url( '/cupcakes/' ) ); ?>" class="<?php echo is_page( 'cupcakes' ) ? 'active' : ''; ?>">Cupcakes</a></li>
				<li><a href="<?php echo esc_url( home_url( '/desserts/' ) ); ?>" class="<?php echo is_page( 'desserts' ) ? 'active' : ''; ?>">Desserts</a></li>
				<li><a href="<?php echo esc_url( home_url( '/cheesecakes/' ) ); ?>" class="<?php echo is_page( 'cheesecakes' ) ? 'active' : ''; ?>">Cheesecakes</a></li>
				<li><a href="<?php echo esc_url( home_url( '/pies/' ) ); ?>" class="<?php echo is_page( 'pies' ) ? 'active' : ''; ?>">Pies</a></li>
				<li><a href="<?php echo esc_url( home_url( '/sweet-treats/' ) ); ?>" class="<?php echo is_page( 'sweet-treats' ) ? 'active' : ''; ?>">Sweet Treats</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="<?php echo is_page( 'about' ) ? 'active' : ''; ?>">About</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/#contact' ) ); ?>">Contact</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#berries' ) ); ?>">Sprinkle Berries</a></li>
				<li><a href="<?php echo esc_url( home_url( '/#instagram' ) ); ?>">Instagram</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/#contact' ) ); ?>" class="menu-order">Order Now</a></li>
			</ul>
		</nav>
	</div>
</header>
