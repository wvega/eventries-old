<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/style.css" />
        <?php wp_head() ?>
        <link href='http://fonts.googleapis.com/css?family=Oregano|Gochi+Hand|Gloria+Hallelujah|Anonymous+Pro|Economica|Homenaje|Lekton|Covered+By+Your+Grace|VT323|Press+Start+2P|PT+Mono' rel='stylesheet' type='text/css'>
    </head>
    <body <?php body_class() ?>>
        <header>
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <a class="brand" href="<?php echo esc_attr(home_url()) ?>">Eventries</a>
                    <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class' => 'nav'
                        )); ?>
                    <?php get_search_form() ?>
                </div>
            </div>
        </header>

        <div id="page" class="container-fluid">
            <div id="content" class="row-fluid">