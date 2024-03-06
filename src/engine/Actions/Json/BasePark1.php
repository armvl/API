<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class BasePark1 extends aAction {

	public function guard() {
		$this->guardByAutoNumbers();
	}

	public function exec() {
		$db = db('base_park_1');

//		$result = $db->query('select * from data where %a order by id desc limit 1 offset 0', [
		$result = $db->query('select * from data where %a order by id desc', [
			$this->searchType => $this->search
		]);

    return $result->fetchAll();
	}
}