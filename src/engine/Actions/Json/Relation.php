<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class Relation extends aAction {

	public function guard() {
		$this->guardByAutoNumbers();
	}

	public function exec() {
		$db = db('base_park_1');

		$result = $db->query('select num,vin,bn,ch,brand,year from data where %a order by id desc limit 1 offset 0', [
			$this->searchType => $this->search
		]);

		$row = $result->fetch();

		return $row ?? [];
	}
}