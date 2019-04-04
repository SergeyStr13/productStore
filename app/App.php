<?php
namespace app;

use app\cart\CartController;
use app\page\PageController;
use app\product\ProductController;
use app\user\UserController;
use app\core\App as BaseApp;

class App extends BaseApp {

	protected function getRoutes() {
		return [
			'/user/users' => [UserController::class, 'users'],
			'/user/add' => [UserController::class, 'add'],
			'/user/update' => [UserController::class, 'update'],
			'/user/delete' => [UserController::class, 'delete'],

			'/' => [ProductController::class, 'products'],
			'/product/products' => [ProductController::class, 'products'],
			'/product/add' => [ProductController::class, 'add'],
			'/product/update' => [ProductController::class, 'update'],
			'/product/delete' => [ProductController::class, 'delete'],

			'/cart' => [CartController::class, 'cart'],
			'/cart/add' => [CartController::class, 'add'],
			'/cart/send' => [CartController::class, 'send'],

			'/main' => [PageController::class, 'main'],
			'/delivery' => [PageController::class, 'delivery'],
			'/contacts' => [PageController::class, 'contacts'],
		];
	}

	protected function getViewPath() {
		return dirname(__DIR__).'/views';
	}

}