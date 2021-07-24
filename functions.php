<?php

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'custom_category',
		[
			'title' => 'Custom category',
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

require_once 'elementor-widgets/index.php';
