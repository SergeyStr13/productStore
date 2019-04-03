<?php
namespace app\product;
use app\core\App;
use PDO;

/**
 * Class books
 */
class Product {

	public $id;
	public $title;
	public $description;
	public $article;
	public $categoryId;
	public $photo;
	public $price;
	public $volume;

	public function __construct($fields = []) {
		foreach ((array)$fields as $field => $value) {
			if (property_exists($this,$field)) {
				$this->$field = $value;
			}
		}
	}

	public static function find($id) {
		$db = App::getInstance()->db->getConnection();
		$query= $db->query("select * from product where id = $id");
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::class);
		$item = $query->fetch();

		//return $item ? new Product($item): null;
		return $item;
	}

	public static function all() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from product");
		$items = $query->fetchAll(\PDO::FETCH_CLASS, self::class);

		//var_dump($books);
		return $items;
	}

	public static function findMany($ids) {
		$db = App::getInstance()->db->getConnection();

		$query = $db->query("select * from product where id in (". implode(',', $ids).")");
		$items = $query->fetchAll(\PDO::FETCH_CLASS, self::class);

		//var_dump($books);
		return $items;
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id) {
			$query = $db->prepare("update product set title = :title, description = :description, "
				."article = :article where product.id= :id");
			$query->execute((array) $this);
		} else {
			$book = (array) $this;
			$keys = array_keys($book);
			$fields = implode(',',$keys);
			$values = implode(',',array_fill(0, count($keys), '?'));

			$query = $db->prepare("insert into product ($fields) values ($values) ");
			$query->execute(array_values($book));
		}
	}

	public function delete() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->prepare("delete from product where product.id = ?");
		$query->execute([$this->id]);
	}
}