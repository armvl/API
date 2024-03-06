<?php

namespace Api;

class App {

	public static $clientKey = '';
	public static $client = [];
	public static $out = null;
	public static $action = '';

	public $segments = [];
	public $response = null;

	public function __construct() {
		self::$out = new Output();
	}

	public function guardRequest() {
		if ( ! in_array($_SERVER['REMOTE_ADDR'], ALLOWED_IP))
			warn('access denied #PL');

		if (empty($_GET['client']) || ! is_string($_GET['client']) || ! preg_match(REG['client'], $_GET['client']))
			warn('access denied #CLG');

		$client = $_GET['client'];

		if ( ! isset(CLIENTS[$client]))
			warn('access denied #CL');

		$uri = strstr($_SERVER['REQUEST_URI'], '?', true);

		if ( ! preg_match('#^/'.FIRST_SEGMENT.'/[a-zа-я0-9%/_-]{2,200}$#ui', $uri))
			warn('access denied #SR');

		$path = trim(parse_url($uri, PHP_URL_PATH), '/');

		$segments = explode('/', $path);

		$action = $segments[1] ?? '';

		if ( ! $action || ! isset(ACTIONS[$action]))
			warn('access denied #AC');

		if ((count($segments) - 2) != ACTIONS[$action]['segments'])
			warn('access denied #SG');

		$this->segments = array_slice($segments, 2);

		self::$action = ACTIONS[$action];
		self::$clientKey = $client;
		self::$client = CLIENTS[$client];

		$this->assignFormat();
	}

	public function runAction() {
		$class = self::$action['class'];

		if ( ! class_exists($class))
			warn('internal warn #CNF');

		$action = new $class($this->segments);
		$action->guard();

		$this->response = $action->exec();
	}

	public function assignFormat() {
		$class = self::$action['class'];
		$format = FORMAT_JSON;

		if (preg_match('#html#i', $class))
			$format = FORMAT_HTML;

		self::$out->turnFormat($format);
	}
	
	public function display() {
		out($this->response);
	}
}






