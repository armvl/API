<?php

use Api\App;

function redirect($uri, $code = 302) {
	header('Location: '.$uri, true, $code);
	exit;
}

function cleanToRus($str = '') {
  $arr = [
    'A'=>'А','B'=>'В','E'=>'Е','K'=>'К','M'=>'М','H'=>'Н','O'=>'О','P'=>'Р','C'=>'С','T'=>'Т','Y'=>'У','X'=>'Х',
    'a'=>'А','b'=>'В','e'=>'Е','k'=>'К','m'=>'М','h'=>'Н','o'=>'О','p'=>'Р','c'=>'С','t'=>'Т','y'=>'У','x'=>'Х',
  ];

  return mb_strtoupper(strtr(rawurldecode($str), $arr), 'UTF-8');
}

function cleanToLat($str = '') {
  $arr = [
    'А'=>'A','В'=>'B','Е'=>'E','К'=>'K','М'=>'M','Н'=>'H','О'=>'O','Р'=>'P','С'=>'C','Т'=>'T','У'=>'Y','Х'=>'X',
    'а'=>'A','в'=>'B','е'=>'E','к'=>'K','м'=>'M','н'=>'H','о'=>'O','р'=>'P','с'=>'C','т'=>'T','у'=>'Y','х'=>'X',
  ];

  return mb_strtoupper(strtr(rawurldecode($str), $arr), 'UTF-8');
}

function db($base = '', $profiling = false) {
	if (empty(DB[$base]))
		return null;

	$params = [
		'driver' => 'postgre',
		'string' => 'user='.DB[$base]['user'].' host='.DB[$base]['host'].' port='.DB[$base]['port'].' dbname='.DB[$base]['base'].' password='.DB[$base]['pass'],
		'persistent' => true,
	];

	if ($profiling) {
		$params['profiler'] = [
			'file' => PATH_LOG.'sql-'.(is_string($profiling) ? $profiling : DB[$base]['base']).'.log',
			'run' => true,
		];
	}

	return dibi::connect($params);
}

function view($tpl = '', $data = []) {
	return App::$out->view($tpl, $data);
}

function out($data, $status = true, $exit = true) {
	App::$out->out($data, $status, $exit);
}

function warn($msg, $exit = true) {
	App::$out->warn($msg, $exit);
}

// Для фича-флагов может понадобится
function isAdmin() {
  return App::$clientKey == CLIENT_KEY_ADMIN;
}