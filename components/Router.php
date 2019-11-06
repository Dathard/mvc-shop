<?php 

class Router 
{
	private $routes;
	
	public function __construct()
	{
		$routesPatch = ROOT.'/config/routes.php';
		$this->routes = include($routesPatch);

	}

	/**
	 * Return request string
	 * @return string
	 */
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		// Отримати стрічку запиту
		$uri = $this->getURI();

		// Перевірити наявність такого запиту в routes.php
		foreach ($this->routes as $uriPattern => $path) {

			// Порівнюємо $uriPattern і $uri
			if (preg_match("~$uriPattern~", $uri)) {

				// Отримуєм внутрішній шлях із зовнішнього відповідно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);


				// Якщо запит співпадає, визначити який контролер і action обробляють запит
				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				$parameters = $segments;

				// Підключити файл класу-контролера
				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				// Створити об'єкт, викликати метод
				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				if ($result != null) {
					break;
				}

			}

		}
	}

}