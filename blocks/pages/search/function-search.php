<?php

/*
 * Изменение формы поиска
 */
add_filter( 'get_search_form', 'my_search_form' );
function my_search_form( $form ) {

	$form = '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">Запрос для поиска:</label>
		<input class="input mb-2" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Поиск" />
		<input class="button-dark-gray" type="submit" id="searchsubmit" value="Найти" />
	</form>';

	return $form;
}

