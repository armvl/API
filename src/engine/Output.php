<?php

namespace Api;

class Output {

	private $format = FORMAT_JSON;

	public function turnFormat($format = FORMAT_JSON) {
		if (in_array($format, FORMATS))
			$this->format = $format;
	}

	/**
	 * @param $data
	 *   если json - данные
	 *   если html - массив формата ['html/msg', ['msg' => 'text content']]
	 *               1 параметр - шаблон который надо заинклюдить
	 *               2 параметр - массив параметров передаваемые в шаблон
	 * @param bool $status код ответа, если bool false то будет 400
	 * @param bool $exit
	 */
	public function out($data, $status = true, $exit = true) {
		switch ($this->format) {
			case FORMAT_HTML:
				$this->layerHtml($data, $status, $exit);
			break;

			default: // FORMAT_JSON
				jsonOut($data, $status, $exit);
		}
	}

	/**
	 * @param $msg
	 *   строка которую надо отобразить
	 *
	 * @param bool $exit
	 */
	public function warn($msg, $exit = true) {
		$out = [
			FORMAT_JSON => ['msg' => $msg],
			FORMAT_HTML => ['html/msg', ['msg' => $msg]],
		];

		$this->out($out[$this->format], false, $exit);
	}

	public function view($tpl, $params = []) {
		$file = PATH_TPL.trim($tpl, '/ ').'.php';

		if ( ! is_file($file))
			return '';

		extract($params);

		ob_start();
		include $file;
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function layerHtml($data, $status = true, $exit = true) {
		if ( ! is_array($data) || empty($data[0]) || ! is_string($data[0]))
			$data = ['html/msg', ['msg' => 'tpl invalid']];

		$tpl = $data[0] ?? '';
		$params = $data[1] ?? [];

		$page = $this->view($tpl, $params);
		$header = $this->view('html/header', $params);
		$footer = $this->view('html/footer', $params);

		if ( ! $status)
			http_response_code(400);

		header('Content-Type: text/html; charset=utf-8');

		echo $header.$page.$footer;

		if ($exit) exit;
	}
}






