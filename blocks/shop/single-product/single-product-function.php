<?php

/*
 * Добавление таба детали
 */
add_filter( 'woocommerce_product_tabs', 'add_tabs_get' );
function add_tabs_get($tabs) {

    $tabs['tab_det'] = array(
        'title'    => 'Детали',
        'priority' => 10,
        'callback' => 'my_product_description_tabs_get'
    );

    return $tabs;
};

function my_product_description_tabs_get() {

    get_template_part( 'woocommerce/single-product/tabs/details', 'details' );

};

/*
 * Добавление Удаление табов
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;
}


/*
 * Добавление Переименование табов
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

    $tabs['faqs']['title'] = __( 'Вопросы' );  // Rename the reviews tab


    return $tabs;

}