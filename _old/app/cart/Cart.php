<?php
namespace app\cart;

use app\product\Product;

class Cart {

	private $productsCount = [];

	public function addProduct($productId, $count) {
		/*if (!isset($this->productsCount[$productId])) {
			$this->productsCount[$productId] = 0;
		}
		$this->productsCount[$productId] += $count;*/
		$this->productsCount[$productId] = ($this->productsCount[$productId] ?? 0) + $count;
	}

	public function removeProducts($productId) {
		unset($this->productsCount[$productId]);
	}

	public function getProductCount($productId) {
		return $this->productsCount[$productId] ?? 0;
	}

	public function getPositions() {
		$products = Product::findMany(array_keys($this->productsCount));
		$productsById = array_column($products, null, 'id');

		$positions = [];

		foreach ($this->productsCount as $productId => $count) {
			$positions[] = (object) [
				'product' => $productsById[$productId],
				'count' => $count
			];
		}

		return $positions;
	}


}