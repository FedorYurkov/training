<?php
/**
* Класс для работы с базой данных
*/
class Db
{
	
	public static function getConnection()
	{
		$params = include(ROOT.DS.'config'.DS.'db_params.php');

		$db = new mysqli($params['host'], $params['user'], $params['password'], $params['dbname']);

		$db->query('SET NAMES "utf8"');

		return $db;
	}
}
//
?>