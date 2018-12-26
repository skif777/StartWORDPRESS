<?php  

/*
 * Инспектирование скриптов и стилей
 */
function wpcustom_inspect_scripts_and_styles() {
 global $wp_scripts;
 global $wp_styles;
 $scripts_list = '';
 $styles_list = '';
 // Runs through the queue scripts
 foreach( $wp_scripts->queue as $handle ) :
   $scripts_list .= $handle . ' | ';
 endforeach;

 // Runs through the queue styles
 foreach( $wp_styles->queue as $handle ) :
   $styles_list .= $handle . ' | ';
 endforeach;

 printf('Scripts: %1$s  Styles: %2$s', 
   $scripts_list . "<br>", 
   $styles_list);
}

add_action( 'wp_print_scripts', 'wpcustom_inspect_scripts_and_styles' );



add_action( 'wp_head', 'show_head_scripts', 9999 );
add_action( 'wp_footer', 'show_footer_scripts', 9999 );

// Appear on the top, before the header
function show_head_scripts(){
	global $wp_scripts;
	echo '<pre class="text-center">'; print_r($wp_scripts->done); echo '</pre>';
}
// Appear on the bottom, after the footer
function show_footer_scripts(){
	global $wp_scripts;
	echo '<pre class="text-center">'; print_r($wp_scripts->done); echo '</pre>';
}