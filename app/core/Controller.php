<?php
namespace app\core;

class Controller {

	private $viewPath;
	private $name;

	protected $layout = 'main';
	protected $app;
	protected $request;
	protected $uri;

	public function __construct() {
		//$this->appPath = dirname(__DIR__);
		preg_match('#([^\\\\]+)Controller#',get_class($this),$matches);
		$this->name = $matches[1];
		$this->app = App::getInstance();
		$this->viewPath = $this->app->viewPath;
		$this->request = $this->app->request;
		$this->uri = $this->app->uri;
	}

	public function render($view, $params = []) {

		$viewName = "{$this->viewPath}/{$this->name}/{$view}.php";
		extract($params, EXTR_SKIP);

		ob_start();
		include $viewName;
		$content = ob_get_clean();

		$layoutName = "{$this->viewPath}/layout/{$this->layout}.php";
		include $layoutName;
	}
}