<?php
namespace app\authorisation;

use app\core\Session;
use app\user\User;

class Authorisation {

	public function authorise($user) {
		//$userId = User::findByLogin($this->user);
		$session = new Session();
		$session->set('authUserId', $user->id);
		//var_dump($user->id); exit();
	}

	public function unAuthorise() {
		$session = new Session();
		$session->clear('authUserId');
	}

	public function authoriseByCredentials($login, $password) {
		$user = User::findByLogin($login);
		if ($user && $user->password === $password) {
			$this->authorise($user);
			return $user;
		}
		return null;
	}

	public function getUser() {
		$session = new Session();
		$userId = $session->get('authUserId');
		if (!$userId) {
			return null;
		}
		return User::find($userId);
	}
}