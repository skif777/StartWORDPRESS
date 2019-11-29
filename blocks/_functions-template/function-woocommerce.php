<?php

/**
 * Объявление поддержки WooCommerce в теме
 */
function mytheme_add_woocommerce_support() {
  
    #Изображение товаров
  add_theme_support( 'woocommerce', array(
    'thumbnail_image_width' => 150,
    'single_image_width'    => 300,

    #Ряды товаров
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
  ) );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );




/**
* Оптимизация скриптов WooCommerce
* Убираем WooCommerce Generator tag, стили, и скрипты для страниц, не относящихся к WooCommerce.
*/
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
 
function child_manage_woocommerce_styles() {
    //убираем generator meta tag
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
 
    //для начала проверяем, активен ли WooCommerce, дабы избежать ошибок
    if ( function_exists( 'is_woocommerce' ) ) {

        //отменяем загрузку скриптов и стилей
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-general' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
        wp_dequeue_style( 'select2' );

        // wp_dequeue_script( 'wc_price_slider' );
        // wp_dequeue_script( 'wc-single-product' );
        // wp_dequeue_script( 'wc-add-to-cart' );
        // wp_dequeue_script( 'wc-cart-fragments' );
        // wp_dequeue_script( 'wc-checkout' );
        // wp_dequeue_script( 'wc-add-to-cart-variation' );
        // wp_dequeue_script( 'wc-cart' );
        // wp_dequeue_script( 'wc-chosen' );
        // wp_dequeue_script( 'woocommerce' );
        // wp_dequeue_script( 'prettyPhoto' );
        // wp_dequeue_script( 'prettyPhoto-init' );
        // wp_dequeue_script( 'jquery-blockui' );
        // wp_dequeue_script( 'jquery-placeholder' );
        // wp_dequeue_script( 'fancybox' );
        // wp_dequeue_script( 'jqueryui' );
        // wp_dequeue_script( 'selectWoo' );

        // wp_deregister_script( 'selectWoo' );
        // wp_deregister_script( 'wc_price_slider' );
        // wp_deregister_script( 'wc-single-product' );
        // wp_deregister_script( 'wc-add-to-cart' );
        // wp_deregister_script( 'wc-cart-fragments' );
        // wp_deregister_script( 'jquery-core' );
        // wp_deregister_script( 'jquery-migrate' );
        // wp_deregister_script( 'jquery' );
        // wp_deregister_script( 'jquery-blockui' );
        // wp_deregister_script( 'js-cookie' );
        // wp_deregister_script( 'woocommerce' );
        
    }
 
}

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
  function is_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { 
      return true; 
    } else { 
      return false; 
    }
  }
}

/**
 * Load woocomerce function
 */
if ( function_exists( 'is_woocommerce_activated' ) ) {
  require get_template_directory() . '/inc/woocomerce-functions.php';
}

/**
   * Display Header Cart
   *
   */
  function my_theme_header_cart() {
    
  ?>

  <ul>
    <li>
      <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
    </li>
  </ul>
  
  <?php
    }

add_action( 'theme-woocomerce-header', 'my_theme_header_cart' );




/**
 * 
 */
function gulp_single_product_params($data)
{
    wp_localize_script( 'scripts', 'wc_single_product_params', $data );

    return false;
}
add_filter('wc_single_product_params', 'gulp_single_product_params');

function gulp_cart_fragments_params($data)
{
    wp_localize_script( 'scripts', 'wc_cart_fragments_params', $data );

    return false;
}
add_filter('wc_cart_fragments_params', 'gulp_cart_fragments_params');