<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class BasePark2 extends aAction {

	public function guard() {
		$this->guardByAutoNumbers(['vin', 'bn', 'ch']);
	}

	public function exec() {
		$db = db('base_park_2');

		$result = $db->query('select * from data where %a order by id desc', [
			$this->searchType => $this->search
		]);

		$rows = $result->fetchAll();

		return $rows;
	}
}