<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class CustomText extends Widget_Base{
  public function __construct($data = [], $args = null) {
    parent::__construct($data, $args);

    wp_register_script( 'script-handle', get_template_directory_uri().'/elementor-widgets/custom_text/assets/js/scripts.js', [ 'elementor-frontend' ], '1.0.0', true );
  }

  public function get_script_depends() {
    return [ 'script-handle' ];
  }

  public function get_name(){
    return 'custom_text';
  }

  public function get_title(){
    return 'Custom text';
  }

  public function get_icon(){
    return 'fa fa-sync';
  }

  // public function get_categories(){
  //   return ['custom_category'];
  // }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'label_heading',
      [
        'label' => 'Label Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Example Heading'
      ]
    );

    $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => 'Title',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Default title',
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => 'Content',
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => 'Default content',
			]
		);

    $this->add_control(
			'list',
			[
				'label' => 'repeater list',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => 't',
						'list_content' => 'asd',
					],
				],
        'title_field' => '{{{ list_title }}}',
			]
		);

    $this->end_controls_section();
  }
  

  protected function render(){
    $settings = $this->get_settings_for_display();
    ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/elementor-widgets/custom_text/assets/css/styles.css">
    <div class="custom_text">
      <div>
        <?php echo $settings['label_heading']?>
      </div>
    </div>
    <?php if($settings['list']): ?>
      <?php foreach($settings['list'] as $item): ?>
        <div><?php echo $item['list_title']; ?></div>
        <div><?php echo $item['list_content']; ?></div>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php
  }
}