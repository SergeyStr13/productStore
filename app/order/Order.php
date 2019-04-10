<?php
namespace app\order;

use app\App;
use app\core\Collection;
use PDO;

class Order {
	public $id;
	public $userId;
	public $createDate;
	public $status = 1;

	public function __construct($fields = []) {
		foreach ((array) $fields as $field => $value) {
			if (property_exists($this, $field)) {
				$this->$field = $value;
			}
		}
	}

	public static function find($id) {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from `order` where id=$id"); // todo: сделать безопасно через плейсхолдер
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::class);
		return $query->fetch();
	}

	public static function allWithPositionAndUser() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("SELECT `order`.id as orderId, `order`.createDate, `order`.status, user.name as userName, product.*, orderposition.count ".
			"FROM product ".
				"LEFT JOIN orderposition on product.id = orderposition.productId ".
				"left JOIN `order` on orderposition.orderId = `order`.id ".
				"LEFT JOIN user on `order`.userId = user.id ");
		$items = $query->fetchAll(\PDO::FETCH_OBJ);

		$items = Collection::groupBy($items, 'orderId');
		$orders = [];
		foreach ($items as $positions) {
			$order = $positions[0];
			$orders[] = (object) [
				'id' => $order->orderId,
				'createDate' => $order->createDate,
				'statusText' => $order->status == 1 ? 'В ожидании' : 'Отправлен',
				'status' => $order->status,
				'userName' =>$order->userName,
				'positions' => $positions
			];
		}
		return $orders;
	}

	public static function getOrderProducts() {
		$db = App::getInstance()->db->getConnection();

	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id) {
			$query = $db->prepare("update `order` set userId = :userId, createDate = :createDate, status = :status where id= :id");
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