<?php
namespace app\order;

use app\App;

class Order {
	public $id;
	public $userId;
	public $createDate;

	public function __construct($fields = []) {
		foreach ((array) $fields as $field => $value) {
			if (property_exists($this, $field)) {
				$this->$field = $value;
			}
		}
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id) {
			$query = $db->prepare("update `order` set userId = :userId, createDate = :createDate where id= :id");
			$query->execute((array) $this);
			return $this->id;
		} else {
			$item = (array) $this;
			$keys = array_keys($item);
			$fields = implode(',',$keys);
			$values = implode(',',array_fill(0, count($keys), '?')); // "'".implode("','", array_values($user))."'";
			$query = $db->prepare("insert into `order` ({$fields}) values ({$values}) ");
			$query->execute(array_values($item));
			return $this->id = $db->lastInsertId();
		}
	}
}