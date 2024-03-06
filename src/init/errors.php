<?php

use Api\App;

function handlerException($e) {
	$code = $e->getCode();
	$message = $e->getMessage();
	$trace = $e->getTraceAsString();
	$file = $e->getFile();
	$line = $e->getLine();
	$class = get_class($e);

	if (ERROR_LOGGING) {
		$msecs = round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 3) * 1000;

		if ($msecs < 100) 
			$msecs = '0'.$msecs;
		elseif ($msecs > 1000) 
			$msecs = $msecs % 1000;

		$client = App::$client['slug'] ?? '';
    $message = html_entity_decode($message);

		$line = '['.date('Y-m-d H:i:s').'.'.$msecs.']['.$client.']['.$class.']['.$message.']['.$file.']['.$line."]\n";
		
		file_put_contents(PATH_LOG.'errors.log', $line, FILE_APPEND);
	}
  else {
		$str = "<div style='border:1px solid #8f8f8f;padding:7px 9px;margin:10px 0;border-radius:7px;font:14px Ubuntu,Consolas,sans-serif;'>";
		$str .= '<b>['.$class.']</b><div style="color:#0000b9;padding:6px 0;line-height:1.3em;">'.$message.'</div>in <b>'.$file.'</b> on line <b>'.$line.'</b>';
		$str .= "<hr style='margin:7px 0;padding:0;border:0;border-top:1px solid #aaa;'>";
		$str .= "<pre style='font-size:12px;margin:0;'>$trace</pre></div>";
		echo $str;
	}

	return true;
}

function handlerError($errno, $errstr, $errfile, $errline) {
	if ($errno & error_reporting())
		throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

set_error_handler('handlerError');
set_exception_handler('handlerException');