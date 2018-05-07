<?php 

/*
 * Добавление Счетчика товаров к корзине
 */
if ( ! function_exists( 'underscores_cart_count' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function underscores_cart_count() {
		?>
			<?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'underscores' ), WC()->cart->get_cart_contents_count() ) );?>
			
		<?php
	}
}
