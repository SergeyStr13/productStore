<?php
namespace app\core;

abstract class App {

	/** @var Request $request */
	public $request;

	/** @var Database $db */
	public $db;

	/** @var string $uri */
	public $uri;

	/** @var Router $router */
	private $router;

	/** @var string $path */
	private $path;

	/** @var string $viewPath */
	public $viewPath;

	/** @var string $uploadPath */
	public $uploadPath;

	/** @var static $instance */
	private static $instance;

	public function __construct() {
		$this->path = dirname(str_replace('\\', '/',__DIR__), 2);
		$this->viewPath = $this->getViewPath();
		$this->uploadPath = $this->getUploadPath();

		spl_autoload_register([$this,'autoload']);

		$this->request = new Request();
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->uri = preg_replace('#^[^/]#', '/$0', $uri); //'/'.($this->request->get('YPATH') ?? ''); // todo: переименовать YPATH во что-то более подходящее
		$this->db = new Database(['user' => 'root', 'dbname' => 'productstore']);

		$this->router = new Router($this->getRoutes());
		//разобраться
		if (self::$instance === null) {
			self::$instance = $this;
		}
	}

	abstract protected function getRoutes();
	abstract protected function getViewPath();
	abstract protected function getUploadPath();

	public static function getInstance(): self {
		return self::$instance;
	}

	public function run() {

		if (!$this->router->dispatch($this->uri)) {
			echo '404 Page not found';
		}
	}

	public function redirect($uri) {
		header("location: $uri");
		exit();
	}

	private function autoload($className) {
		$file = $this->path.'/'.str_replace('\\','/',$className).'.php';
		//var_dump($file);
		if (is_file($file)) {
			require_once $file;
		}
	}

}
