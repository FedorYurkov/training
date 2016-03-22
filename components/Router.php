<?php
/**
* Класс маршрутизатор
*/
class Router
{
	
	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.DS.'config'.DS.'routes.php';
		$this->routes = include($routesPath);
	}
	
	// Метод для обработки запросов.
	public function start()
	{
		$uri = trim($_SERVER['REQUEST_URI'], '/');
		
		foreach ($this->routes as $uriPattern => $path) {

			// Сравниваем $uriPattern и $uri
			if (preg_match("~$uriPattern~", $uri)) {
				
				// Получаем внутренний путь из внешнего согласно правилу.
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
								
				// Определить контроллер, action, параметры

				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments);

				$methodName = array_shift($segments);
							 
				$parameters = $segments;
				
				// Подключить файл класса-контроллера
				$controllerFile = ROOT.DS.'controllers'.DS.$controllerName.'.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				} else {
					//Тут сделать выход на страницу 404 или показать ошибку c текстом "Неправильный адрес"
					exit('Неправильный адрес');
				}

				// Создать объект, вызвать метод
				$controllerObject = new $controllerName;
							
				$result = call_user_func_array(array($controllerObject, $methodName), $parameters);
								
				if ($result != null) {
					break;
				}
			}
		}
	}		
}
//
?>