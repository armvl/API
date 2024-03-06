<?php

namespace Api\Actions;

abstract class aAction {

  protected $segments;
  protected $search;
  protected $searchType;

  abstract public function guard();
	abstract public function exec();

	public function __construct($segments = []) {
		$this->segments = $segments;
	}

	/**
	 * @param string[] $searchTypes
	 *
	 * Запросы вида (vin|num|ch|bn)/search
	 */
	public function guardByAutoNumbers($searchTypes = ['num', 'vin', 'bn', 'ch']) {
		if (empty($this->segments) || ! is_array($this->segments) || count($this->segments) < 2)
			warn('segments not provided');

		$searchType = trim($this->segments[0]);
		$search = trim(rawurldecode($this->segments[1]));

		if ( ! in_array($searchType, $searchTypes))
			warn('type search invalid');

		$search = $searchType == 'num'
			? cleanToRus($search)
			: cleanToLat($search)
		;

		if ( ! preg_match(REG[$searchType], $search))
			warn('search invalid');

		$this->search = $search;
		$this->searchType = $searchType;
	}
}