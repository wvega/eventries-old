<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
	<title>Eventries</title>
	<meta charset="utf-8" />
	<meta name="author" content="" />
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Amaranth:400,700|Droid+Sans&v2' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
	<?php wp_head(); ?>
</head>
<body>
	<!-- wrapper -->
	<div id="wrapper">
		<!-- header -->
		<header id="eventriesh">
		    <?php if (is_home()) { ?>		
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" title="Calendario de eventos"><span>Eventries - Calendario de eventos</span></a></h1>
			<?php } else { ?>
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" title="Calendario de eventos"><span>Eventries - Calendario de eventos</span></a></h1>
			<?php } ?>
		</header>
		<!-- /header -->
		<!-- mainnav -->
		<div id="mainnav">
		    <!-- menu superior -->
			<nav id="menusp">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu' => 'menu-primary' ) ); ?>
			</nav>
			<!-- /menu superior -->
