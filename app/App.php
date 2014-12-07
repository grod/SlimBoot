<?php

require __DIR__ . '/controllers/ApplicationController.php';

class App extends \Slim\Slim {

  private $controllers = array();

  function __construct( array $config = array() ) {
    parent::__construct($config);
  }

  // Return instance of controller
  function controller( $controller = 'application' ) {

    // Controller already instantiated?
    $instance = array_search($controller, $this->controllers);

    // If not, do it now
    if (!$instance) {
      $class_name = ucfirst($controller).'Controller';
      $file_name = __DIR__.'/controllers/'.$class_name.'.php';

      require_once $file_name;
      
      $instance = new $class_name($this);
      $this->controllers[ $controller ] = $instance;
    }

    return $instance;

  }

}

