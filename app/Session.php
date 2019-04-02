<?php
namespace app;
class Session {

	function start() {
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
	}

	function close() {
		if ( session_status() !== PHP_SESSION_NONE ) {
			session_commit();
		}
	}

	function destroy() {
		if (session_status() !== PHP_SESSION_NONE) {
			setcookie(session_name(), session_id(), time()-60*60*24);
			session_unset();
			session_destroy();
		}
	}
}