<?php
/**
 * Функция для автоматического подключения классов
 */
function __autoload($class_name)
{
	// Список всех директорий с требуемыми классами;
	$array_path = array('models', 'components');

	foreach ($array_path as $path) {
		//Сформируем путь к файлу
		$path = ROOT.DS.$path.DS.$class_name.'.php';
		
		//Если файл сушествует, подключаем его 
		if (is_file($path)) {
			include_once $path;
		}
	}
}

