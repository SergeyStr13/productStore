<?php
namespace app\core;

class Request {

	public function get($var) {
		return $_GET[$var] ?? null;
	}

	public function post($var) {
		return $_POST[$var] ?? null;
	}

	public function isPost(): bool {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return true;
		}
		return false;
	}

	public function file($var) {
		$file = $_FILES[$var] ?? null;
		if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
			return $file;
		}
		return null;
	}

}
