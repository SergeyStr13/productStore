<?php
namespace app\category;

use app\App;
use PDO;
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
		$items = $query->fetchAll(PDO::FETCH_CLASS, self::class);

		return $items;
	}

	public static function find($id) {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from category where id=$id");
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::class);
		return $query->fetch();

	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id) {
			$query = $db->prepare("update category set title = :title where id= :id");
			$query->execute((array) $this);
		} else {
			$item = (array) $this;
			$keys = array_keys($item);
			$fields = implode(',',$keys);
			$values = implode(',',array_fill(0, count($keys), '?')); // "'".implode("','", array_values($user))."'";
			$query = $db->prepare("insert into category ({$fields}) values ({$values}) ");
			$query->execute(array_values($item));
		}
	}

	public function delete() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->prepare("delete from category where id = ?");
		$query->execute([$this->id]);
	}

	public static function getOptions() {
		$items = self::all();
		return array_column($items,'title','id');

	}

}