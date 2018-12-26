<?php 
/*
 * Отключение двойного переноса строки на HTML конструкцию <p>...</p>, а одинарного на <br>
 */
remove_filter( 'the_content', 'wpautop' );