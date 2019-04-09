<?php
namespace app\category;

use app\core\Controller;

class CategoryController extends Controller {

	public function categories() {
		$categories = Category::all();
		$this->layout = 'admin';
		$this->render('categories', compact('categories'));
	}

	public function add() {
		if ($this->request->isPost()) {
			$title = $this->request->post('title') ?? '';
			
			if ($title) {
				$category = new Category(compact('title'));
				$category->save();
				$this->app->redirect('/admin/categories');
			}
		}
		$action = $this->uri;
		$this->layout = 'admin';
		$this->render('form', compact('action'));
	}

	public function update() {
		$id = $this->request->get('id');
		$category = Category::find($id);
		if (!$category) {
			$this->app->redirect('/admin/categories');
		}
		if ($this->request->isPost()) {

			$title = $this->request->post('title') ?? '';

			if ($title) {
				$category->title = $title;
				$category->save();
				$this->app->redirect('/admin/categories');
			}
		}
		$action = $this->uri.'?id='.$id;
		$this->layout = 'admin';
		$this->render('form', compact('action', 'category'));
	}

	public function delete() {
		$id = $this->request->get('id');
		$category = Category::find($id);
		if ($category) {
			$category->delete();
		}
		$this->app->redirect('/admin/categories');
	}


}