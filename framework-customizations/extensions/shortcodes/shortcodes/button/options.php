<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'label'  => array(
		'label' => __( 'Button Label', 'fw' ),
		'desc'  => __( 'This is the text that appears on your button', 'fw' ),
		'type'  => 'text',
		'value' => 'Submit'
	),
	'link'   => array(
		'label' => __( 'Button Link', 'fw' ),
		'desc'  => __( 'Where should your button link to', 'fw' ),
		'type'  => 'text',
		'value' => '#'
	),
	'button-class'   => array(
		'label' => __( 'CSS class кнопки', 'fw' ),
		'desc'  => __( 'Допольнительный class кнопки', 'fw' ),
		'type'  => 'text'
	),
	'target' => array(
		'type'  => 'switch',
		'label'   => __( 'Open Link in New Window', 'fw' ),
		'desc'    => __( 'Select here if you want to open the linked page in a new window', 'fw' ),
		'right-choice' => array(
			'value' => '_blank',
			'label' => __('Yes', 'fw'),
		),
		'left-choice' => array(
			'value' => '_self',
			'label' => __('No', 'fw'),
		),
	),
);