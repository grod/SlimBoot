<?php

$app->get('/', function () use ($app) {
  $app->controller('index')->index();
});

/***********************************************************************
*  Example CRUD routes                                                 *
*  You can safely delete these along with their controllers and views  *
************************************************************************/
$app->get('/posts', function() use ($app) {
  $app->controller('posts')->index();
});

$app->get('/posts/new', function() use ($app) {
  $app->controller('posts')->new_post();
});

$app->post('/posts', function() use ($app) {
  $app->controller('posts')->create();
});

// For truly RESTful apps you should use DELETE and PUT
// instead of GET/POST like in this example.
$app->get('/posts/delete/:id', function($id) use ($app) {
  $app->controller('posts')->destroy($id);
});

$app->get('/posts/edit/:id', function($id) use ($app) {
  $app->controller('posts')->edit($id);
});
$app->post('/posts/update/:id', function($id) use ($app) {
  $app->controller('posts')->update($id);
});

$app->get('/posts(/:id)', function($id) use ($app) {
  $app->controller('posts')->show($id);
});

$app->get('/about', function() use ($app) {
  $app->controller('index')->about();
});

/* Error and 404 */
$app->notFound(function() use ($app) { $app->render('status/404.html'); });
$app->error(function(\Exception $e) use ($app) { $app->render('status/error.html'); });
