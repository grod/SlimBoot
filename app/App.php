<?php namespace SlimBoot;


class App extends \Slim\Slim {

  private $controllers = array();

  function __construct( array $config = array() ) {
    parent::__construct($config);
  }

  // Return instance of controller
  function controller( $controller = 'application' ) {

    // Check if controller already is instantiated.
    if (!array_key_exists($controller, $this->controllers)) {

      // Prepend controller namespace and append Controller to the name.
      // Now it's all ready for PSR-4, which is awesome.
      $class_name = __NAMESPACE__ . '\\Controllers\\' . ucfirst($controller).'Controller';
      if (class_exists($class_name)) {
        $this->controllers[$controller] = new $class_name($this);
      } else {
        // Class not found. Return null
        return null;
      }
    }

    return $this->controllers[$controller];
  }

}

