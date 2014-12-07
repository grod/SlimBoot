<?php

/***********************************************************
 *  Environment settings. This file should be .gitignored  *
 ***********************************************************/

return  [
  'debug' => true,
  'mode'  => 'development',
  'log.enable' => true,
  'log.level'  => \Slim\Log::DEBUG,

  // SQLite
  'db_setup' => function() {
    R::setup(
      'sqlite:../db/development.sqlite3',
      'user',
      'password'
    );
  },

  // MySQL
  // 'db_setup' => function() {
  //   R::setup(
  //     'mysql:host=localhost;'.
  //     'db_name',
  //     'user',
  //     'password'
  //   );
  //
  //   R::freeze( TRUE );
  // }
    
];
