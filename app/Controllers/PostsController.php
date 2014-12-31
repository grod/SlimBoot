<?php namespace SlimBoot\Controllers;

use R;

class PostsController extends ApplicationController {

  function index() {
    $posts = R::findAll('post');
    $this->render('posts/index.html', array(
      'posts' => $posts
    ));
  }

  function new_post() {
    $this->render('posts/new.html');
  }

  function create() {
    $data_array = $this->app->request()->post();
    $new_post = R::dispense('post');
    $new_post->import($data_array);
    $new_post->created = R::isoDateTime();
    $id = R::store($new_post);

    $this->app->redirect('/posts');
  }

  function destroy($id) {
    $post = R::load('post', $id);
    if ($post) {
      R::trash($post);
    }
    $this->app->redirect('/posts');
  }

  function edit($id) {
    $post = R::load('post', $id);
    if ($post) {
      $this->render('posts/edit.html',  array(
        'post' => $post
      ));
    } else {
      $this->render('status/404.html');
    }
  }

  function update($id) {
    $data_array = $this->app->request()->post();
    $post = R::load('post', $id);
    $post->import($data_array);
    $id = R::store($post);
    $this->app->redirect('/posts');
  }

  function show($id) {
    $post = R::load('post', $id);
    if ($post) {
      $this->render('posts/show.html',  array(
        'post' => $post
      ));
    } else {
      $this->render('status/404.html');
    }
  }

}
