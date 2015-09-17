<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php
        if ( is_front_page() ) {
            bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
        } else {
            wp_title(''); echo ' | '; bloginfo( 'name' );
        }?>
    </title>

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<div class="main">
    <div class="content_wrap">

    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                LOGO
                <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Logo"/> -->
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <?php
                wp_nav_menu( array(
                    'menu'              => '',
                    'theme_location'    => '',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => '',
                    'container_id'      => '',
                    'menu_class'        => 'nav navbar-nav navbar-right',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                );
            ?>

        </div><!--/.nav-collapse -->
    </nav><!-- .navbar -->

