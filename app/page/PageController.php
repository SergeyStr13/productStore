<?php
namespace app\page;

use app\core\Controller;

class PageController extends Controller {

	public function main() {
		$this->render('main');
	}

	public function delivery() {
		$this->render('delivery');
	}

	public function contacts() {
		$this->render('contacts');
	}

}