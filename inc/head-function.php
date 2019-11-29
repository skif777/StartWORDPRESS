<?php

/**
 * Head
 */

function my_wp_head_css() {
?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<!-- Favicon settings -->
	<link rel="manifest" href="<?php echo get_bloginfo('template_url'); ?>/manifest.json"/>
	<meta name="msapplication-config" content="<?php echo get_bloginfo('template_url'); ?>/configfile.xml" />
	<link rel="icon" sizes="48x48" href="<?php echo get_bloginfo('template_url');?>/images/Favicon/icon-48x48.png">
	<link rel="icon" sizes="96x96" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-96x96.png">
	<link rel="icon" sizes="144x144" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-144x144.png">
	<link rel="icon" sizes="192x192" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-192x192.png">
	<link rel="icon" sizes="256x256" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-256x256.png">
	<link rel="icon" sizes="384x384" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-384x384.png">
	<link rel="icon" sizes="512x512" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/icon-512x512.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-167x167.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/apple-touch-icon-180x180.png">
	<link rel="mask-icon" href="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/safari-pinned-tab.svg" color="#ff0000">
	<meta name="msapplication-TileColor" content="#ff0000">
	<meta name="msapplication-TileImage" content="<?php echo get_bloginfo('template_url'); ?>/images/Favicon/ms-tile-144x144.png">
	<!-- chrome, firefox OS and opera-->
	<meta name="theme-color" content="#000"/>
	<!-- windows phone-->
	<meta name="msapplication-navbutton-color" content="#000"/>
	<!-- ios safari-->
	<meta name="apple-mobile-web-app-status-bar-style" content="#000"/>
	<!-- Preloading fonts-->
	<link rel="preload" href="<?php echo get_bloginfo('template_url'); ?>/fonts/Montserrat/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
  <!-- Preload Styles-->
  <style>body{opacity:0;overflow-x:hidden;} html{background-color: #000;}
	<?php
		if (is_page('homepage')) {

			include(__DIR__.'/../css/critical-home.css');

		} elseif (is_page('home'))  { // for WC - is_shop() || is_product() || is_product_category()

			include(__DIR__.'/../css/critical-shop.css'); 

		} else {
				
    }
    ?>
    </style>
    <?php
}
add_action('wp_head', 'my_wp_head_css', 999 );