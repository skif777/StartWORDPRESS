<?php

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
function my_deregister_javascript() {
  if ( !is_page('location') ) {

  	// Снятие с регистрации стилей
	//wp_deregister_style( 'dashicons' ); 

	// Отключение стилей
	wp_dequeue_style( 'wp-postratings' ); // - Подключен в footer
	wp_dequeue_style( 'wp-block-library' ); // - Подключен в footer



  	// Снятие с регистрации скриптов
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed' );

	// Отключение скриптов
	wp_dequeue_script( 'wp-postratings' ); // - Подключен в footer 

  }
}
add_action( 'wp_enqueue_scripts', 'my_deregister_javascript', 100 


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

