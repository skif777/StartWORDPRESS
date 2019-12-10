<?php

/**
 * Enqueue scripts and styles.
 */
function new_project_2_scripts() {

  $min = ''; // приисвоит значение .min для подключения минифиц. файлов

  wp_register_style( 'new-project-2-main-style', get_template_directory_uri() . '/css/main' . $min . '.css', array(), '1.2', 'all');

  wp_enqueue_style( 'new-project-2-main-style' );
  wp_enqueue_style( 'new-project-2-style', get_stylesheet_uri() );
  wp_enqueue_style( 'wp-postratings' );
  wp_enqueue_style( 'wp-block-library' );
  wp_enqueue_style( 'fw-ext-builder-frontend-grid' );
  wp_enqueue_style( 'fw-ext-forms-default-styles' );
  wp_enqueue_style( 'woocommerce-inline' );
  wp_enqueue_style( 'megamenu' );
  wp_enqueue_style( 'wc-block-style' );
  wp_enqueue_style( 'dashicons' );

  wp_enqueue_script( 'new-project-2-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  wp_enqueue_script( 'new-project-2-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
  wp_enqueue_script( 'new-project-2-responsivetabs', get_template_directory_uri() . '/js/jquery.responsivetabs.js', array('jquery'), '20151215', true );

  wp_register_script( 'new-project-2-popper', get_template_directory_uri() . '/js/popper.min.js', array(), '20151215'. true );
  wp_enqueue_script( 'new-project-2-popper' );

  wp_register_script( 'new-project-2-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215'. true );
  wp_enqueue_script( 'new-project-2-bootstrap' );

  wp_enqueue_script( 'new-project-2-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '20151215', true );
  wp_enqueue_script( 'new-project-2-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), '20151215', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
  }

  wp_enqueue_script( 'wp-postratings' );
  wp_enqueue_script( 'woocommerce' );
  wp_enqueue_script( 'wc-cart-fragments' );
  wp_enqueue_script( 'wc-add-to-car' );
  wp_enqueue_script( 'hoverIntents' );
  wp_enqueue_script( 'megamenu' );

  /* Регистрация и подключение JS */
	wp_register_script( 'jquery', ( get_template_directory_uri() . '/js/jquery-3.4.1.min.js' ), array(), '20151215', true );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'new_project_2_scripts' );

/*
 * Добавление атрибута async к js файлам
 */
function add_async_attribute($tag, $handle) {
  // add script handles to the array below
  $scripts_to_async = array(
    'jquery',
    'new-project-webfont-loaded',
    'new-project-2-navigation',
    'new-project-2-skip-link-focus-fix',
    'new-project-2-responsivetabs',
    'new-project-2-bootstrap',
    'new-project-2-imagesloaded',
    'new-project-2-masonry',
  );

  foreach($scripts_to_async as $async_script) {
     if ($async_script === $handle) {
        return str_replace(' src', ' async="async" src', $tag);
     }
  }
  return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/*
 * Проверят является ли текущая постоянная страница дочерней страницей
 * Возвращает true или false
 */
function is_subpage() {
	global $post;

	if ( is_page() && $post->post_parent ) {
		return $post->post_parent;
	} 
	return false;
}

/*
 * Отключение скриптов и стилей
 */
function my_theme_disable_scripts() {
  if ( !is_page('location') ) {

  	// Снятие с регистрации стилей
	//wp_deregister_style( 'dashicons' ); 

	// Отключение стилей
	wp_dequeue_style( 'wp-postratings' ); 
	wp_dequeue_style( 'wp-block-library' );


  // Снятие с регистрации скриптов
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed' );

	// Отключение скриптов
	wp_dequeue_script( 'wp-postratings' );

  }
}
add_action( 'wp_enqueue_scripts', 'my_theme_disable_scripts', 200 );


/**
 * Enqueue scripts and styles.
 */
function my_scripts() {

	/* Регистрация стилей */
	wp_register_style( 'wow-style', get_template_directory_uri() . '/style.css', array(), '1.2', 'all');

	/* Подключение CSS файлов */
	if( is_front_page() ) {
		wp_enqueue_style( 'wow-style' );
	}
	elseif (is_page('blog')) {
		echo "id";
	}
	else {
		wp_enqueue_style( 'wow-style' );
	}

	/* Регистрация и подключение JS */
	wp_register_script( 'jquery', ( get_template_directory_uri() . '/js/jquery-3.2.1.min.js' ), array(), '20151215', true );
	wp_enqueue_script( 'jquery' );

	/* Подключение JS */
	wp_enqueue_script( 'wow-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', false );
	wp_enqueue_script( 'wow-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_footer', 'my_scripts');


/**
 * Подключение инлайн css.
 */
function my_wp_head_css() {
	if (is_page('homepage')) {
		echo "<style>";
		include 'css/critical-home.css'; 
		echo "</style>";
	} elseif (is_shop() || is_product() || is_product_category())  {
		echo "<style>";
		include 'css/critical-shop.css'; 
		echo "</style>";
	} else {
    	
	}
}
add_action('wp_head', 'my_wp_head_css', 1 );

