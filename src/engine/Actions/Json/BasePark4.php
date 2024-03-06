<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class BasePark4 extends aAction {

	public function guard() {
		$this->guardByAutoNumbers(['num', 'vin']);
	}

	public function exec() {
		$db = db('base_park_4');

		$result = $db->query('select * from data where %a order by id desc', [
			$this->searchType => $this->search
		]);

		$rows = $result->fetchAll();

		return $rows;
	}
}