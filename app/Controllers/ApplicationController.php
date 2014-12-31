<?php namespace SlimBoot\Controllers;

class ApplicationController {

  function __construct($app) {
    $this->app = $app; 
  }

  function render( $template, $data = array() ) {
  
    // Project wide variables
    $data['action'] = $this->app->router()->getCurrentRoute();
    $data['project_name'] = 'SlimBoot';

    $this->app->render($template, $data);

  }

}
