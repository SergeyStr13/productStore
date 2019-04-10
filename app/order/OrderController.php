<?php
namespace app\order;

use app\core\Controller;

class OrderController  extends Controller {

	public function orders() {
		$orders = Order::allWithPositionAndUser();
		$this->layout = 'admin';
		$this->render('orders', compact('orders'));
	}

	public function send() {
		$id = $this->request->get('id');
		$order = Order::find($id);
		$order->status = 2;
		$order->save();
		$this->app->redirect('/admin/orders');
	}

}