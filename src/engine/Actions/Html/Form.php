<?php

namespace Api\Actions\Html;

use Api\Actions\aAction;

class Form extends aAction {

	public function guard() {}

	public function exec() {
		return ['html/form'];
	}
}