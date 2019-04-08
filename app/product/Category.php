<?php
namespace app\product;

use app\App;

class Category {
	public $id;
	public $title;

	public function __construct($fields = []) {
		foreach ((array)$fields as $field => $value) {
			if (property_exists($this,$field)) {
				$this->$field = $value;
			}
		}
	}

	public static function all() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from category");
		$items = $query->fetchAll(\PDO::FETCH_CLASS, Category::class);

		return $items;
	}

	public static function getOptions() {
		$items = self::all();
		return array_column($items,'title','id');

	}

}