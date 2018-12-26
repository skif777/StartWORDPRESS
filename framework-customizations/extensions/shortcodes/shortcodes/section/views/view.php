<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_color = '';
if ( ! empty( $atts['background_color'] ) ) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';';
}

$bg_image = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$data_name_attr = version_compare( fw_ext('shortcodes')->manifest->get_version(), '1.3.9', '>=' ) ? 'data-background-options' : 'data-wallpaper-options';
	$bg_video_data_attr = $data_name_attr.'="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $atts['video'] ) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}

$section_comment = ( isset( $atts['section_class'] ) && $atts['section_class'] ) ? '<!-- ' . 'Section ' . $atts['section_class'] . ' -->' : '';
$section_comment_end = ( isset( $atts['section_class'] ) && $atts['section_class'] ) ? '<!-- ' . 'End section ' . $atts['section_class'] . ' -->' : '';
$section_style   = ( $bg_color || $bg_image ) ? 'style="' . esc_attr($bg_color . $bg_image) . '"' : '';
$section_html_before = ( isset( $atts['html_before'] ) && $atts['html_before'] ) ? $atts['html_before'] : '';
$section_html_after = ( isset( $atts['html_after'] ) && $atts['html_after'] ) ? $atts['html_after'] : '';
$section_attributes = ( isset( $atts['section_attributes'] ) && $atts['section_attributes'] ) ? $atts['section_attributes'] : '';
$container_class = ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) ? 'container-fluid' : 'container';
$section_content = ( isset( $atts['section_class'] ) && $atts['section_class'] ) ? $atts['section_class'] : 'section';
$section_class = ( isset( $atts['section_class'] ) && $atts['section_class'] ) ? ' ' . $atts['section_class'] . '': '';
$section_id = ( isset( $atts['custom_id'] ) && $atts['custom_id'] ) ? ' id=' . $atts['custom_id'] . '': '';
?>
<?php echo $section_comment; ?>
<section<?php echo $section_id; ?> class="fw-main-row<?php echo $section_class; ?> <?php echo esc_attr($section_extra_classes) ?>" <?php echo $section_style; ?> <?php echo $bg_video_data_attr; ?> <?php echo $section_attributes; ?>>
	<div class="<?php echo esc_attr($container_class); ?>">
		<?php echo $section_html_before; ?>
		<div class="<?php echo $section_content; ?>__content">
			<?php echo do_shortcode( $content ); ?>
		</div>
		<?php echo $section_html_after; ?>
	</div>
</section>
<?php echo $section_comment_end; ?>


