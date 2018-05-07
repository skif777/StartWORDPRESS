<?php

/**
 * Регистрация меню
 */
register_nav_menus( array(
    'category-menu' => esc_html__( 'Category menu', 'web-action' ),
) );

/*
 * Изменение добавление CSS классов к LI
 */
add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
	if( $item->ID === 118 && $args->theme_location === 'menu-1' ){
		$classes[] = 'fa fa-folder-open';
	}

	return $classes;
}