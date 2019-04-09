<?php
namespace app\product;
use app\core\App;
use PDO;

class Product {

	public $id;
	public $title;
	public $description;
	public $article;
	public $categoryId;
	public $photo;
	public $price;
	public $volume;

	public $categoryTitle;

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

	public static function find($id) {
		$db = App::getInstance()->db->getConnection();
		//$query= $db->query("select * from product where id=$id");
		$query = $db->query("select * from product where id=$id");
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,Product::class);
		$product = $query->fetch();

		return $product ? new Product($product): null;
		//return $product;
	}

	/**
	 * @return Product[]
	 */
	public static function all() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select * from product");
		$items = $query->fetchAll(\PDO::FETCH_CLASS, self::class);

		//var_dump($books);
		return $items;
	}

	public static function allWithCategory() {
		$db = App::getInstance()->db->getConnection();
		$query = $db->query("select product.*, category.title as categoryTitle from product LEFT JOIN category on product.categoryId = category.id");
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
		return $items;
	}

	public static function groupBy($items, $key) {
		$result = [];
		foreach ($items as $item) {
			$result[$item->$key][] = $item;
		}
		return $result;
	}

	public function save() {
		$db = App::getInstance()->db->getConnection();
		if ($this->id != null) {
			$query = $db->prepare("update product set title = :title, description = :description, article = :article, "
			."categoryId = :categoryId, photo = :photo, price = :price, volume = :volume where product.id= :id");
			$query->execute(array_diff_key((array) $this, ['categoryTitle' => '']));
		} else {
			$product= array_diff_key((array) $this, ['categoryTitle' => '']);
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