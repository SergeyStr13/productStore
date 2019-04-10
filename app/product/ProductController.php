<?php
namespace app\product;

use app\category\Category;
use app\core\Collection;
use app\core\Controller;
use app\core\File;

class ProductController extends Controller{

	public function Products() {
		$message = '';
		$messageAlias = $this->request->get('message') ?? '';
		if ($messageAlias === 'cartSend') {
			$message = 'Заказ успешно оформлен';
		} else if ($messageAlias === 'addedToCart') {
			$message = 'Товар добавлен в корзину';
		}
		$products = Product::allWithCategory();
		$products = Collection::groupBy($products,'categoryTitle');


		//var_dump($products);
		//exit();
		$this->render('products', compact('products','message'));
	}

	public function manageProducts() {
		$products = Product::allWithCategory();
		$this->layout = 'admin';
		$this->render('manageProducts', compact('products'));
	}

	/**  Product $product*/
	public function add() {
		//var_dump($category);

		if ($this->request->isPost()) {
			$article = $this->request->post('article');
			$title = $this->request->post('title');
			$description = $this->request->post('description');

			$categoryId = (int) $this->request->post('categoryId') ?? 0;
			$price = $this->request->post('price') ?? 0;
			$volume = $this->request->post('volume');

			//$photo = $this->request->post('photo') ?? null;
			/*$photo = $_FILES['photo']['name'];
			if ($photo !== null) {
				$uploadImages = dirname(__DIR__, 2).'\public\images\products\\';
				$uploadfile = $uploadImages . basename($_FILES['photo']['name']);
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
			} */
			$photoFile = $this->request->file('photo');
			$photo = '';
			if ($photoFile !== null) {
				$uploadPath = $this->app->uploadPath.'/images/products';
				$photo = File::upload($photoFile, $uploadPath);
			}

			if ($title && $article && $description) {
				//$categoryId = Category::getTitleCategory($categoryId);
				$product = new Product(compact('article', 'title', 'description','categoryId','photo','price','volume'));

				$product->save();
				$this->app->redirect('/admin/products');
			}
		}
		$categories = Category::getOptions();
		$action = $this->uri;
		$this->layout = 'admin';
		$this->render('form', compact('categories','action'));
	}

	public function update() {
		$id = $this->request->get('id');
		$product = Product::find($id);

		if (!$product) {
			$this->app->redirect('/admin/products');
		}

		if ($this->request->isPost()) {
			$article = $this->request->post('article');
			$title = $this->request->post('title');
			$description = $this->request->post('description');
			$categoryId = $this->request->post('categoryId') ?? 0;
			$price = $this->request->post('price') ?? 0;
			$volume = $this->request->post('volume');

			$photo = $this->request->file('photo');
			if ($photo !== null) {
				$uploadPath = $this->app->uploadPath.'/images/products';
				$product->photo = File::upload($photo,$uploadPath);
			}

			if ($title && $article && $description) {
				$product->title = $title;
				$product->description = $description;
				$product->article = $article;
				$product->categoryId = $categoryId;
				$product->price = $price;
				$product->volume = $volume;

				$product->save();
				$this->app->redirect('/admin/products');
			}
		}
		$categories = Category::getOptions();
		$action = $this->uri.'?id='.$id;
		$this->layout = 'admin';
		$this->render('form', compact('categories','action', 'product'));
	}

	public function delete() {
		$id = $this->request->get('id');
		$product = Product::find($id);
		if ($product) {
			if ($product->photo) {
				$path = $this->app->uploadPath.'/images/products/';
				$file = new File($path.$product->photo);
				$file->delete();
			}
			$product->delete();
		}
		$this->app->redirect('/admin/products');
	}
}