<?php

// Composer autoload
require __DIR__ . '/vendor/autoload.php';


// Init Twig template engine
Twig_Autoloader::register();
$view = new \Slim\Views\Twig();

// Config, logging and bootstrapping code and ideas borrowed from 
// https://github.com/magnus-eriksson/slim-app-template
// By Magnus Eriksson

$config = [
    'debug'            => false,
    'app_path'         => __DIR__ . '/app',
    'log_path'         => __DIR__ . '/logs',
    'public_path'      => __DIR__ . '/public',
    'view'             => $view,
    'templates.path'   => __DIR__ . '/app/views',
    'controllers_path' => __DIR__ . '/app/controllers',
    'conf_global'      => __DIR__ . '/app/config.global.php',
    'conf_env'         => __DIR__ . '/app/config.env.php',
];

// App instance
$app = new SlimBoot\App($config);

// Global config file
if (is_file($app->config('conf_global'))) {
  foreach(include $app->config('conf_global') as $key => $value) {
    $app->config($key, $value);
  }
}

// Environment specific config file
if (is_file($app->config('conf_env'))) {
  foreach(include $app->config('conf_env') as $key => $value) {
    $app->config($key, $value);
  }
}

// Setup Database
if ( is_callable( $app->config('db_setup') ) ) {
  $db_setup = $app->config('db_setup');
  $db_setup();
}

// Logging
$logPath = $app->config('log_path');
$logFile = 'slim_log.log';
if (is_dir($logPath) && is_writable($logPath)) {
  $app->environment['slim.errors'] = $logPath . '/' . $logFile;
}

include $app->config('app_path') . '/routes.php';

$app->run();
