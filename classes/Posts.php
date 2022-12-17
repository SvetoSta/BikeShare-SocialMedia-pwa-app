<?php

class Posts {

  private $_db,
          $_data,
          $_postsSrc;

  public function __construct($posts = null)
  {
    $this->_db = DB::getInstance();
    $this->_postsSrc = Config::get('posts/posts_src');

    $this->find($posts);

  }


  public function create($fields)
  {
    if(!$this->_db->insert('posts', $fields)) {
      throw new Exception('There was a problem adding the posts.');
    }
  }

  public function log($posts = null){    
   
    $posts = $this->find($posts);

    if($this->data()->src === !null) {
      Session::put($this->_postsSrc, $this->data()->src);

    }
  }

  public function find($posts = null)
  {
    if($posts) {
      $field = (is_numeric($posts)) ? 'id' : 'src';
      $data = $this->_db->get('posts', array($field, '=', $posts));
      if($data->count()) {
        $this->_data = $data->first();
        return true;
      }
    }
    return false;
  }

  public function exists()
  {
    return (!empty($this->_data)) ? true : false;
  }


  public function data()
  {
    return $this->_data;
  }

}
