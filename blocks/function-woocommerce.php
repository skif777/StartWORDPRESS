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