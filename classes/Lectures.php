<?php

class Lectures {

  private $_db,
          $_data,
          $_lecturesSrc;

  public function __construct($lectures = null)
  {
    $this->_db = DB::getInstance();
    $this->_lecturesSrc = Config::get('lectures/lectures_src');

    $this->find($lectures);

  }


  public function create($fields)
  {
    if(!$this->_db->insert('lectures', $fields)) {
      throw new Exception('There was a problem adding the lecture.');
    }
  }

  public function log($lectures = null){    
   
    $lectures = $this->find($lectures);

    if($this->data()->src === !null) {
      Session::put($this->_lecturesSrc, $this->data()->src);

    }
  }

  public function find($lectures = null)
  {
    if($lectures) {
      $field = (is_numeric($lectures)) ? 'id' : 'src';
      $data = $this->_db->get('lectures', array($field, '=', $lectures));
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
