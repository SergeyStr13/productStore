<?php
namespace app\cart;

use app\core\Controller;
use app\core\Session;
use app\product\Product;

class CartController extends Controller{

	private function getCart() {
		$session = new Session();
		return $session->get('cart') ?? new Cart();
	}

	public function cart() {
		$positions = $this->getCart()->getPositions();
		//var_dump($positions);
		//exit();
		$this->render('cart', compact('positions'));
	}

	public function send() {
		$session = new Session();
		$session->clear('cart');
		$this->app->redirect('/product/products?message=cartSend');
	}

	public function add() {
		$productId = $this->request->get('product');

		if (!Product::find($productId)) {
			die('Товар не найден');
		}

		$cart = $this->getCart();
		$cart->addProduct($productId, 1);
		$session = new Session();
		$session->set('cart', $cart);
		$this->app->redirect('/product/products');
	}


	public  function delete() {
		$id = $this->request->get('id');
		$product = Cart::find($id);
		if ($product) {
			$product->delete();
		}
		$this->app->redirect('/product/cart');
	}
}