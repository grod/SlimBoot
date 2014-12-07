<?php

class IndexController extends ApplicationController {

  function index() {
    $title = 'Index';
    $body = 'This is the body';

    $this->render('index/index.html', array(
      'title' => $title,
      'body' => $body
    ));
  }

  function about() {
    $this->render('index/about.html');
  }

}
