<?php
namespace app\core;

class Collection {

	public static function groupBy($items, $key) {
		$result = [];
		foreach ($items as $item) {
			$result[$item->$key][] = $item;
		}
		return $result;
	}

}