<?php
namespace app\cart;

use app\order\OrderPosition;
use app\product\Product;

class Cart {

	public $positions = [];


	public function addProduct($productId, $count) {
		if (!isset($this->positions[$productId])) {
			$this->positions[$productId] =  new OrderPosition(compact('productId', 'count'));
		} else {
			$this->positions[$productId]->count += $count;
		}
	}

	public function removeProducts($productId) {
		unset($this->positions[$productId]);
	}

	public function getProductCount($productId) {
		return $this->positions[$productId]->count ?? 0;
	}

	public function getPositionsProduct() {
		$products = Product::findMany(array_keys($this->positions));
		$productsById = array_column($products, null, 'id');

		$positions = [];
		foreach ($this->positions as $productId => $position) {
			$position->product = $productsById[$productId];
			$positions[$productId] = $position;
		}
		return $positions;
	}


}