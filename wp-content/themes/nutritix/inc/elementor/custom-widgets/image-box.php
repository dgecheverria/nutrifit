<?php
use Elementor\Controls_Manager;

add_action( 'elementor/element/image-box/section_image/before_section_end', function ($element, $args ) {
	$element->add_control(
		'image_style',
		[
			'label'   => esc_html__( 'Style', 'nutritix' ),
			'type'    => Controls_Manager::SELECT,
			'default'   => 'style-1',
			'options' => [
				'style-1'       => esc_html__( 'Style 1', 'nutritix' ),
				'style-2'       => esc_html__( 'Style 2', 'nutritix' ),
			],
			'prefix_class' => 'nutritix-image-box-',
		]
	);
}, 10, 2 );
