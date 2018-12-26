<?php
/*
 * Регистрация сайдбара
 */
function true_register_wp_sidebars() {
 
	/* В боковой колонке - первый сайдбар */
	register_sidebar(
		array(
			'id' => 'true_side', // уникальный id
			'name' => 'Фильтры категорий', // название сайдбара
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
			'before_widget' => '<div id="%1$s" class=" %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>',
			'before_title' => '', // по умолчанию заголовки виджетов в <h2>
			'after_title' => ''
		)
	);

}
 
add_action( 'widgets_init', 'true_register_wp_sidebars' );