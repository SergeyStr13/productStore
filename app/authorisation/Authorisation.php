<?php
namespace app\authorisation;

use app\core\Session;
use app\user\User;

class Authorisation {

	public $user;

	public function authorise($user) {
		//$userId = User::findByLogin($this->user);
		$session = new Session();
		$session->set('authUserId', $user->id);
	}

	public function authoriseByCredentials($login, $password) {
		$user = User::findByLogin($login);
		$this->user = $user;
		if ($login && $user->password === $password) {
			$this->authorise($user);
		}
		return true;
	}
}