<?php
namespace app\core;

class File {

	public $filename;

	public function __construct($filename) {
		$this->filename = $filename;
	}

	public function delete()  {
		//var_dump($this->filename);
		if (is_file($this->filename)) {
			unlink($this->filename);
		}
	}

	public static function upload($file, $path, $filename = null) {
		$ext = self::getExtension($file['name']);
		if (!$filename) {
			$filename = File::uniqueFilename($path,$ext);
		}
		if (!move_uploaded_file($file['tmp_name'], $path.'/'.$filename)) {
			return null;
		}

		return $filename;
	}

	public static function uniqueFilename(string $path, string $extension, int $length = 10): string {
		$extension = $extension ? '.'.$extension : '';
		do {
			$filename = substr(bin2hex(openssl_random_pseudo_bytes(16)), 0, $length).$extension;
		} while (is_file($path.'/'.$filename));
		return $filename;
	}

	public static function getExtension(string $filename): string {
		if (preg_match('#\.([^\.]+)$#', $filename, $matches)) {
			return $matches[1];
		}
		return '';
	}

}