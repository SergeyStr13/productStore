<?php
namespace app\product;
use app\core\App;
use PDO;

/*
 * Class product
 * @property-read string $article
 * @property-read string $photo
 * @property-read int $price
 * @property-read string $volume *
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

	/**
	 * Product constructor.
	 * @param array $fields
	 */
	public function __construct($fields = []) {
		foreach ((array)$fields as $field => $value) {
			if (property_exists($this,$field)) {
				$this->$field = $value;
			}
		}
	}

	/**
	 * @param $id
	 * @return mixed
	 */
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
		if (!$ids) {
			return [];
		}
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from product where id in (". implode(',', $ids).")");
		$items = $query->fetchAll(\PDO::FETCH_CLASS, self::class);
		//var_dump($books);
		return $items;
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id != null) {
			$query = $db->prepare("update product set title = :title, description = :description, "
				."article = :article where product.id= :id");
			$query->execute((array) $this);
		} else {
			$product= (array) $this;
			$keys = array_keys($product);
			$fields = implode(',',$keys);
			$values = implode(',',array_fill(0, count($keys), '?'));

			$query = $db->prepare("insert into product ($fields) values ($values) ");
			$query->execute(array_values($product));
		}
	}

	public function delete() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->prepare("delete from product where product.id = ?");
		$query->execute([$this->id]);
	}
}