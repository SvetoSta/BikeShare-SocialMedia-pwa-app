<?php

class Validate {

  private $_passed = false,
          $_errors = array(),
          $_db     = null;

  public function __construct()
  {
    $this->_db = DB::getInstance();
  }

  public function check($source, $items = array())
  {
    foreach ($items as $item => $rules) {

      foreach($rules as $rule => $rule_value) {// we have access to each rule based on each field
        $value =  trim($source[$item]);
        $item = escape($item);
        if ($rule === 'required' && empty($value)) { // checking if it actually exists and if it is required
          $this->addError("{$item} is required");
        } else if(!empty($value)){
          switch ($rule) {

            case 'min':
              if (strlen($value) < $rule_value) {
                $this->addError("{$item} must be a minimun of {$rule_value} characters.");
              }
            break;

            case 'max':
            if (strlen($value) > $rule_value) {
              $this->addError("{$item} must be a maximum of {$rule_value} characters.");
            }
            break;

            case 'matches':
              if ($value != $source[$rule_value]) {
                $this->addError("<h1 class='testh1'>New password does not match.</h1>");
              }
            break;

            case 'unique':
              $check = $this->_db->get($rule_value, array($item, '=', $value));
              if ($check->count()) {
                $this->addError("{$item} already exists.");
              }
            break;

            default:
            
              break;
          }
        }
      }
    }
    if (empty($this->_errors)) { // check array that is stored
      $this->_passed = true;
    }
    return $this;
  }

  private function addError($error)
  {
    $this->_errors[] = $error; // adding error to the errors array
  }

  public function errors()
  {
    return $this->_errors; // return the list of errors we have
  }

  public function passed()
  {
    return $this->_passed;
  }

}