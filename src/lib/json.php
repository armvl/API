<?php

function json($data = [], $status = true, $exit = true) {
	$output = json_encode($data, JSON_UNESCAPED_UNICODE);

//	if ( ! $status)
//		http_response_code(is_int($status) ? $status : 400);

	header('Content-Type: application/json');
	header('Content-Length: '.strlen($output));

	echo $output;

	if ($exit) exit;
}

function jsonOut($data = [], $status = true, $exit = true) {
	$data = ['result' => $data, 'success' => $status];
	json($data, $status, $exit);
}

function jsonWarn($msg = '', $exit = true) {
	jsonOut(['msg' => $msg], false);
}