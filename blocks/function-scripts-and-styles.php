<?php

/**
 * Enqueue scripts and styles.
 */
function web_action_scripts() {
	wp_enqueue_style( 'web-action-style', get_stylesheet_uri() );

	if (is_page('homepage')) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/home.css' );
	}
	if (is_shop() || is_product() || is_product_category()) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/shop.css' );
	}
	if (is_page('cart')) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/cart.css' );
	}
	if ( is_404() ) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/404.css' );
	}
	if (is_page('checkout')) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/page-checkout.css' );
	}
	if (is_page('my-account')) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/my-account.css' );
	}
	if ( is_search() ) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/search.css' );
	}
	if (is_subpage()) {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/subpages.css' );
	}
	else {
		wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/theme-style.css' );
	}

	wp_enqueue_script( 'web-action-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'web-action-js', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true );

	wp_enqueue_script( 'web-action-webfont', get_template_directory_uri() . '/js/webfont-loaded.js', array(), '20151215', true );

	wp_enqueue_script( 'web-action-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'web_action_scripts' );