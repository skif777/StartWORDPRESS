<?php if (!defined('FW')) die( 'Forbidden' ); 

$button_class = ( isset( $atts['button_class'] ) && $atts['button_class'] ) ? ' ' . $atts['button_class'] . '': '';

?>
<?php $color_class = !empty($atts['color']) ? "fw-btn-{$atts['color']}" : ''; ?>
<a href="<?php echo esc_attr($atts['link']) ?>" target="<?php echo esc_attr($atts['target']) ?>" class="button <?php echo $button_class; ?> <?php echo esc_attr($color_class); ?>">
	<span><?php echo $atts['label']; ?></span>
</a>