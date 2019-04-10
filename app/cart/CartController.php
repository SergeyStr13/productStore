<?php
namespace app\cart;

use app\authorisation\Authorisation;
use app\core\Controller;
use app\core\Session;
use app\order\Order;
use app\product\Product;

class CartController extends Controller {

	private function getCart() {
		$session = new Session();
		return $session->get('cart') ?? new Cart();
	}

	public function cart() {
		$positions = $this->getCart()->getPositionsProduct();
		//var_dump($positions);
		//exit();
		$this->render('cart', compact('positions'));
	}

	/*public function carts() {
		$carts = $this->getCart()->getPositionsProduct();
		$this->layout = 'admin';
		$this->render('carts', compact('carts'));
	}*/

	public function add() {
		$productId = $this->request->get('product');
		if (!Product::find($productId)) {
			die('Товар не найден');
		}
		$cart = $this->getCart();
		$cart->addProduct($productId, 1);
		$session = new Session();
		$session->set('cart', $cart);
		$this->app->redirect('/product/products?message=addedToCart');
	}

	public function send() {
		$session = new Session();
		$auth = new Authorisation();
		$userId = $auth->getUser()->id;
		$cart = $session->get('cart');
		if ($cart && $cart->positions) {
			$order = new Order(['userId' => $userId, 'createDate' => date('Y-m-d') ]);
			$orderId = $order->save();
			foreach ($cart->positions as $position) {
				$position->orderId = $orderId;
				$position->save();
			}
			$session->clear('cart');
		}
		$this->app->redirect('/product/products?message=cartSend');
	}

	/*	public  function delete() {
		$id = $this->request->get('id');
		$product = Cart::find($id);
		if ($product) {
			$product->delete();
		}
		$this->app->redirect('/product/cart');
	}*/
}