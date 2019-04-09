<?php
namespace app;

use app\cart\CartController;
use app\category\CategoryController;
use app\page\PageController;
use app\product\ProductController;
use app\user\UserController;
use app\core\App as BaseApp;

class App extends BaseApp {

	protected function getRoutes() {
		return [
			'/' => [ProductController::class, 'products'],

			'/admin' => [UserController::class, 'signIn'],
			'/admin/sign-out' => [UserController::class, 'signOut'],
			'/sign-in' => [UserController::class, 'signIn'],

			'/admin/users' => [UserController::class, 'users'],
			'/admin/users/add' => [UserController::class, 'add'],
			'/admin/users/update' => [UserController::class, 'update'],
			'/admin/users/delete' => [UserController::class, 'delete'],

			'/admin/categories' => [CategoryController::class, 'categories'],
			'/admin/categories/add' => [CategoryController::class, 'add'],
			'/admin/categories/update' => [CategoryController::class, 'update'],
			'/admin/categories/delete' => [CategoryController::class, 'delete'],

			'/products' => [ProductController::class, 'products'],
			'/admin/products' => [ProductController::class, 'manageProducts'],
			'/admin/products/add' => [ProductController::class, 'add'],
			'/admin/products/update' => [ProductController::class, 'update'],
			'/admin/products/delete' => [ProductController::class, 'delete'],

			'/cart' => [CartController::class, 'cart'],
			'/admin/carts' => [CartController::class, 'carts'],
			'/cart/add' => [CartController::class, 'add'],
			'/cart/send' => [CartController::class, 'send'],

			'/main' => [PageController::class, 'main'],
			'/delivery' => [PageController::class, 'delivery'],
			'/contacts' => [PageController::class, 'contacts'],
		];
	}

	protected function getViewPath() {
		return dirname(str_replace('\\', '/',__DIR__)).'/views';
	}

	protected function getUploadPath() {
		return dirname(str_replace('\\', '/',__DIR__)).'/public';
	}

}