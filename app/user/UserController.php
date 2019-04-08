<?php
namespace app\user;

use app\authorisation\Authorisation;
use app\core\Controller;

class UserController extends Controller {

	public function signIn() {
		$login = $this->request->post('login');
		$password = $this->request->post('password');
		if ($login && $password) {
			//$user = User::findByLogin($login);
			$auth = new Authorisation();
			$user = $auth->authoriseByCredentials($login, $password);
			if (!$user) {
				$this->app->redirect('/admin');
				//die('Логин или пароль не совпадают');
			};
			$this->app->redirect('/admin/users');
		}
		$action = $this->uri;
		$this->layout = 'admin';
		$this->render('signIn', compact('action'));
	}

	public function signOut() {
		$auth = new Authorisation();
		$auth->unAuthorise();
		$this->app->redirect('/admin');
	}

	public function users() {
		$users = User::all();
		$this->layout = 'admin';
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
				$this->app->redirect('/admin/users');
			}
		}
		$action = $this->uri;
		$this->layout = 'admin';
		$this->render('form', compact('action'));
	}

	public function update() {
		$id = $this->request->get('id');
		$user = User::find($id);
		if (!$user) {
			$this->app->redirect('/admin/users');
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
				$this->app->redirect('/admin/users');
			}
		}
		$action = $this->uri.'?id='.$id;
		$this->layout = 'admin';
		$this->render('form', compact('action', 'user'));
	}

	public function delete() {
		$id = $this->request->get('id');
		$user = User::find($id);
		if ($user) {
			$user->delete();
		}
		$this->app->redirect('/admin/users');
	}


}