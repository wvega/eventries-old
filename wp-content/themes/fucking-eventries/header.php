<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta content="index,follow" name="robots" /> 
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"" type="text/css" media="screen" />
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="index" title="Eventries" href="http://eventries.com" />
	<?php wp_head(); ?>
</head>
<body>
	<div id="wrapper">
		<!-- top -->
		<div id="header">
			<div id="logo">
				<h1><a href="http://eventries.com" title="Ir al inicio" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo_eventos.png" alt="Los eventos" /></a></h1>
			</div>
			<div id="search">
			    <ul id="maintop">
			        <li><a href="">Contacto</a></li>
			        <li><a href="">Acerca de</a></li>
			    </ul>
				<form action="<?php bloginfo('url'); ?>/" method="get" id="searchform">
			        <div> 
				        <label for="q">Buscar</label> 
				        <input type="text" id="s" name="s" class="text" value="Buscar..." onfocus="if (this.value=='Buscar...') this.value='';" /> 
				        <input class="submit" type="submit" value="Buscar" /> 
			        </div> 
		        </form>
			</div>
		</div>
		<!-- /top -->
		<!-- main -->
		<div id="main">
			<div id="head">
				<h1>Bienvenido</h1>
				<div id="intro">
					En Eventries podr&aacute;s encontrar todos los eventos Tecnol&oacute;gicos, Acad&eacute;micos y Culturales que se llevan a cabo en Colombia
				</div>
			</div>
