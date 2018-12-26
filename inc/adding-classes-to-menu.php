<?php
/**
 * Изменение класса у тега LI
 */
add_filter( 'nav_menu_css_class', 'filter_function_header_menu', 10, 4 );
function filter_function_header_menu( $classes, $item, $args, $depth ){
	if ( $args->theme_location === 'header_menu' ) {

		$classes = [
			'menu__item',
		];

	}
	return $classes;
}

/**
 * Изменение класса у тега LI
 */
add_filter( 'nav_menu_css_class', 'filter_function_name_8591', 10, 4 );
function filter_function_name_8591( $classes, $item, $args, $depth ){
	if ( $args->theme_location === 'footer_menu-1' ) {

		$classes = [
			'site-footer__links-block_item',
			'item' . ( $depth + 1 ) // уровень вложености элемента
		];

		if ( $item->current ) {
			$classes[] = 'active'; // Добавляет к активным меню
		}

	}
	return $classes;
}

/**
 * Изменение класса у тега LI
 */
add_filter( 'nav_menu_css_class', 'filter_function_footer_menu2', 10, 4 );
function filter_function_footer_menu2( $classes, $item, $args, $depth ){
	if ( $args->theme_location === 'footer_menu-2' ) {

		$classes = [
			'site-footer__navigation-list_item',
		];

	}
	return $classes;
}

/**
 * Изменение класса у тега LI
 */
add_filter( 'nav_menu_css_class', 'filter_function_footer_menu3', 10, 4 );
function filter_function_footer_menu3( $classes, $item, $args, $depth ){
	if ( $args->theme_location === 'footer_menu-3' ) {

		$classes = [
			'site-footer__navigation-list_item',
		];

	}
	return $classes;
}


/**
 * Изменение класса у submenu
 */
add_filter( 'nav_submenu_css_class', 'filter_nav_submenu_css_class', 10, 4 );
function filter_nav_submenu_css_class( $classes, $item, $args, $depth ){
	if ( $args->theme_location === 'footer_menu-1' ) {

		$classes = [
			's22',
		];

		if ( $item->current ) {
			$classes[] = 'active'; // Добавляет к активным меню
		}
	}
	return $classes;
}


/**
 * Удаление атрибутов id из меню
 */
add_filter( 'nav_menu_item_id', 'filter_function_name_471', 10, 4 );
function filter_function_name_471( $menu_id, $item, $args, $depth ) {

	return $args->theme_location === 'footer_menu-1' ? '' : $menu_id;

}

/**
 * Удаление атрибутов id из меню
 */
add_filter( 'nav_menu_item_id', 'filter_function_header_menu1', 10, 5 );
function filter_function_header_menu1( $menu_id, $item, $args, $depth ) {

	return $args->theme_location === 'header_menu' ? '' : $menu_id;

}

/**
 * Удаление атрибутов id из меню
 */
add_filter( 'nav_menu_item_id', 'filter_nav_menu_item_id_footer_menu2', 10, 4 );
function filter_nav_menu_item_id_footer_menu2( $menu_id, $item, $args, $depth ) {

	return $args->theme_location === 'footer_menu-2' ? '' : $menu_id;

}

/**
 * Удаление атрибутов id из меню
 */
add_filter( 'nav_menu_item_id', 'filter_nav_menu_item_id_footer_menu3', 10, 4 );
function filter_nav_menu_item_id_footer_menu3( $menu_id, $item, $args, $depth ) {

	return $args->theme_location === 'footer_menu-3' ? '' : $menu_id;

}


/**
 * Изменение класса у тега <a> в меню
 */
add_filter( 'nav_menu_link_attributes', 'filter_menu_link_attributes', 10, 4 );
function filter_menu_link_attributes( $atts, $item, $args, $depth ) {

	if ( $args->theme_location === 'footer_menu-1' ) {

		$atts['class'] = 'site-footer__links-block_link';

		if ( $item->current ) {
			$atts['class'] .= 'active';
		}

	}

	return $atts;
}

/**
 * Изменение класса у тега <a> в меню
 */
add_filter( 'nav_menu_link_attributes', 'filter_menu_link_header_menu', 10, 4 );
function filter_menu_link_header_menu( $atts, $item, $args, $depth ) {

	if ( $args->theme_location === 'header_menu' ) {

		$atts['class'] = 'menu__link f1-R';

		if ( $item->current ) {
			$atts['class'] .= 'active';
		}

	}

	return $atts;
}

/**
 * Изменение класса у тега <a> в меню
 */
add_filter( 'nav_menu_link_attributes', 'filter_menu_link_footer_menu2', 10, 4 );
function filter_menu_link_footer_menu2( $atts, $item, $args, $depth ) {

	if ( $args->theme_location === 'footer_menu-2' ) {

		$atts['class'] = 'site-footer__navigation-list_link f1-L';


	}

	return $atts;
}

/**
 * Изменение класса у тега <a> в меню
 */
add_filter( 'nav_menu_link_attributes', 'filter_menu_link_footer_menu3', 10, 4 );
function filter_menu_link_footer_menu3( $atts, $item, $args, $depth ) {

	if ( $args->theme_location === 'footer_menu-3' ) {

		$atts['class'] = 'site-footer__navigation-list_link f1-L';

	}

	return $atts;
}



