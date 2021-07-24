<?php
namespace WPC;

class Widget_Loader{

  private static $_instance = null;

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  private function include_widgets_files(){
    // IMPORT CUSTOM WIDGET FILES
    require_once(__DIR__ . '/custom-text/index.php');
  }

  public function register_widgets(){

    $this->include_widgets_files();

    // CUSTOM WIDGET INSTANCES
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CustomText());

  }

  public function __construct(){
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
  }
}

Widget_Loader::instance();