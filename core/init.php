<?php

session_start();

$GLOBALS['config'] = array(
  'mysql' => array(
    'host' => 'studmysql01.fhict.local',
    'username' => 'dbi433416',
    'password' =>  '123',
    'db' => 'dbi433416'
  ),
  'remember' => array(
    'cookie_name' => 'hash',
    'cookie_expiry' => 604800
  ),

  'session' => array(
    'session_name' => 'user',
    'token_name' => 'token'
  ),

  'posts' => array(
    'posts_src' => 'src'
  ),

  'lectures' => array(
    'lectures_src' => 'src'
  )
);

spl_autoload_register(function($class) {
  require_once 'classes/'. $class . '.php';
});

require_once 'functions/sanitize.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
  $hash = Cookie::get(Config::get('remember/cookie_name'));
  $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
  if ($hashCheck->count()) {
    $user = new User($hashCheck->first()->user_id);
    $user->login();
  }
}
