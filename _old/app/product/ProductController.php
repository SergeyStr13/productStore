<?php
namespace app\product;

use app\core\Controller;

class ProductController extends Controller{

	public function Products() {
		$message = '';
		if ($this->request->get('message') === 'cartSend') {
			$message = 'Заказ успешно оформлен';
		}
		$products = Product::all();
		//$products = [];
		$this->render('products', compact('products','message'));
	}

	public function manageProducts() {
		$products = Product::all();
		$this->render('manageProducts', compact('products'));
	}

	/**  Product $product*/
	public function add() {
		if ($this->request->isPost()) {
			$article = $this->request->post('article');
			$title = $this->request->post('title');
			$description = $this->request->post('description');
			$categoryId = (int) $this->request->post('categoryId') ?? 0;
			$price = $this->request->post('price') ?? 0;
			$volume = $this->request->post('volume');
			$photo = $this->request->post('photo');

			if ($title && $article && $description) {
				$product = new Product(compact('article', 'title', 'description','categoryId','photo','price','volume'));
				$product->save();
				$this->app->redirect('/product/manageProducts');
			}
		}
		$action = $this->uri;
		$this->render('form', compact('action'));
	}

	public function update() {
		$id = $this->request->post('id');
		$product = Product::find($id);

		if (!$product) {
			$this->app->redirect('/products');
		}

		if ($this->request->isPost()) {
			$article = $this->request->post('article');
			$title = $this->request->post('title');
			$description = $this->request->post('description');
			$categoryId = $this->request->post('categoryId') ?? 0;
			$price = $this->request->post('price') ?? 0;
			$volume = $this->request->post('volume');
			$photo = $this->request->post('photo');

			if ($title && $article && $description) {
				$product->title = $title;
				$product->description = $description;
				$product->author = $article;
				$product->categoryId = $categoryId;
				$product->price = $price;
				$product->volume = $volume;
				$product->photo = $photo;

				$product->save();
				$this->app->redirect('/product/products');
			}
		}
		$action = $this->uri.'?id='.$id;
		$this->render('form', compact('action', 'product'));
	}

	public  function delete() {
		$id = $this->request->get('id');
		$product = Product::find($id);
		if ($product) {
			$product->delete();
		}
		$this->app->redirect('/product/products');
	}
}