<!-- Logo -->
<div class="top-line__logo">
	<?php
	the_custom_logo();
	if ( is_front_page() && is_home() ) :
		?>
		<h1 class="top-line__logo_title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
	else :
		?>
		<p class="top-line__logo_title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	endif;
	$web_action_description = get_bloginfo( 'description', 'display' );
	if ( $web_action_description || is_customize_preview() ) :
		?>
		<p class="top-line__logo_description"><?php echo $web_action_description; /* WPCS: xss ok. */ ?></p>
	<?php endif; ?>
</div>
<!-- End logo -->