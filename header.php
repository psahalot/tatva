<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package Tatva
 * @since Tatva 1.0
 */
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="cleartype" content="on">

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed site">

	<div class="visuallyhidden skip-link"><a href="#primary" title="<?php esc_attr_e( 'Skip to main content', 'tatva' ); ?>"><?php esc_html_e( 'Skip to main content', 'tatva' ); ?></a></div>

	<div id="headercontainer">

		<header id="masthead" class="site-header row" role="banner">
			<div class="col grid_6_of_12 site-title">
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
						<?php 
						$headerImg = get_header_image();
						if( !empty( $headerImg ) ) { ?>
							<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
						<?php } 
						else {
							echo get_bloginfo( 'name' );
						} ?>
					</a>
				</h1>
                                <p class="site-description"> 
                                    <?php if (empty($headerImg)) { 
                                            echo get_bloginfo('description'); 
                                    } ?>
                                </p>
			</div> <!-- /.col.grid_6_of_12 -->
                        
                        <div class="col grid_6_of_12 header-extras last">                        
                            <?php dynamic_sidebar('header-widget'); ?>
                         </div><!-- /.header-extras -->
		</header> <!-- /#masthead.site-header.row -->
                
                <div class="nav-container">
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                            <div class="col grid_12_of_12">
					<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'tatva' ); ?></h3>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                            </div>
                    </nav> <!-- /.site-navigation.main-navigation -->
                </div><!-- /.nav-container -->
	</div> <!-- /#headercontainer -->
