<?php
namespace app\order;

use app\App;

class OrderPosition {

	public $orderId;
	public $productId;
	public $count;

	public $product;

	public function __construct($fields = []) {
		foreach ((array) $fields as $field => $value) {
			if (property_exists($this, $field)) {
				$this->$field = $value;
			}
		}
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		$item = array_diff_key((array) $this, ['product' => '']);
		$keys = array_keys($item);
		$fields = implode(',',$keys);
		$values = implode(',',array_fill(0, count($keys), '?')); // "'".implode("','", array_values($user))."'";
		$query = $db->prepare("insert into orderposition ({$fields}) values ({$values}) ");
		$query->execute(array_values($item));
	}

	public function update() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->prepare("update orderposition set orderId = :orderId, productId = :productId, count = :count where id= :id");
		$query->execute((array) $this);
	}

}