<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'is_fullwidth' => array(
		'label'        => __('Full Width', 'fw'),
		'type'         => 'switch',
	),
	'background_color' => array(
		'label' => __('Background Color', 'fw'),
		'desc'  => __('Please select the background color', 'fw'),
		'type'  => 'color-picker',
	),
	'background_image' => array(
		'label'   => __('Background Image', 'fw'),
		'desc'    => __('Please select the background image', 'fw'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'video' => array(
		'label' => __('Background Video', 'fw'),
		'desc'  => __('Insert Video URL to embed this video', 'fw'),
		'type'  => 'text',
	),
	'section_class' => array(
		'label' => __('Section class', 'fw'),
		'desc'  => __('Insert custom section class', 'fw'),
		'type'  => 'text',
	),
	'custom_id' => array(
		'label' => __('Section ID', 'fw'),
		'desc'  => __('Insert custom section id', 'fw'),
		'type'  => 'text',
	),
	'html_before' => array(
		'label'        => __('Before HTML code', 'fw'),
		'desc'  	   => __('HTML code до основного конента секции', 'fw'),
		'type'         => 'text',
	),
	'html_after' => array(
		'label'        => __('After HTML code', 'fw'),
		'desc'  	   => __('HTML code после основного конента секции', 'fw'),
		'type'         => 'text',
	)

);
