<?php

Class Input {
  
  public static function exists($type = 'post')
  {
    switch ($type) {
      case 'post':
          return (!empty($_POST)) ? true : false;
        break;

      case 'get':
        return (!empty($_GET)) ? true : false;
      break;

      default:
          return false;
        break;
    }
  }

  public static function get($item)
  {
    if (isset($_POST[$item])) { // checking if post data is available
      return $_POST[$item];
    } else if (isset($_GET[$item])) { // checking if get data is available
      return $_GET[$item];
    }
    return ''; // if this data doesnt exit we want to return something back
  }



}
