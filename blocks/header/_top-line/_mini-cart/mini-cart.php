<!-- Mini-cart -->
<div class="top-line__cart">
	<a href="/checkout" class="top-line__cart_link">Корзина</a>
	<span class="top-line__cart-count"><?php underscores_cart_count(); ?></span>
	<ul id="site-header-cart" class="top-line__cart-content">
		<li>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</li>
	</ul>
</div>
<!-- End Mini-cart -->