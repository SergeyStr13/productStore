<?php
namespace app\user;

use app\core\Controller;

class UserController extends Controller {

	public function users() {
		$users = User::all();
		$this->render('users', compact('users'));
	}

	public function add() {
		if ($this->request->isPost()) {
			$name = $this->request->post('name') ?? '';
			$login = $this->request->post('login') ?? '';
			$password = $this->request->post('password') ?? '';
			$email = $this->request->post('email') ?? '';

			if ($name && $login && $email) {
				$user = new User(compact('name','login','password','email'));
				$user->save();
				$this->app->redirect('/users');
			}
		}

		$action = $this->uri;
		$this->render('form', compact('action'));
	}

	public function update() {
		$id = $this->request->get('id');
		$user = User::find($id);
		if (!$user) {
			$this->app->redirect('/users');
		}
		if ($this->request->isPost()) {
			$name = $this->request->post('name') ?? '';
			$login = $this->request->post('login') ?? '';
			$password = $this->request->post('password') ?? '';
			$email = $this->request->post('email') ?? '';
			if ($name && $login && $email) {
				// $user = new User(compact('name','login','password','email'));
				$user->name = $name;
				$user->login = $login;
				$user->password = $password;
				$user->email = $email;

				$user->save();
				$this->app->redirect('/users');
			}
		}
		$action = $this->uri.'?id='.$id;

		$this->render('form', compact('action', 'user'));
	}

	public function delete() {
		$id = $this->request->get('id');
		$user = User::find($id);
		if ($user) {
			$user->delete();
		}
		$this->app->redirect('/users');
	}


}