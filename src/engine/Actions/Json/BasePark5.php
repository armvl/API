<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class BasePark5 extends aAction {

  public $db;

  public function guard() {
//		$this->guardByAutoNumbers();
    $this->db = db('base_park_5');
  }

  public function exec() {
    return [];
  }
}
