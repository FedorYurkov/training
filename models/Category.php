<?php
/**
* Класс Category - это модель для работы с категориями товаров;
*/
class Category
{
	//Метод возвращает массив с данным всех категорий;
	public static function getAllCategories()
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `categories` ORDER BY `id`;";

		$result = $db->query($sql);
		$result = $result->fetch_all(MYSQLI_ASSOC);

		return $result;
	}

	//Метод возвращает массив с данными одной конкретной категории;
	public static function getCategoryById($categoryId)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `categories` WHERE `id`=".$categoryId.";";

		$result = $db->query($sql);
		$result = $result->fetch_array(MYSQLI_ASSOC);

		return $result;
	}

	// Метод создает новую категорию, data - массив данных;
	public static function createCategory($data)
	{
		$db = Db::getConnection();

		$sql = "INSERT INTO `categories` (`title`, `text`)
							VALUES ('".$db->real_escape_string($data['title'])."',
									'".$db->real_escape_string($data['text'])."');";   
		$result = $db->query($sql);

		return $result;
	}

	// Метод редактирует указанную категорию, data - массив новых данных;
	public static function editCategory($id, $data)
	{
		$db = Db::getConnection();

		$sql = "UPDATE `categories` SET 
									`title` = '".$db->real_escape_string($data['title'])."',
									`text` = '".$db->real_escape_string($data['text'])."'
									WHERE `id`=".intval($id).";";
		$result = $db->query($sql);

		return $result;
	}

	// Метод удаляет указаную категорию;
	public static function deleteCategoryById($id)
	{
		$db = Db::getConnection();

		$sql = "DELETE FROM `categories` WHERE `id`=".intval($id).";";

		$result = $db->query($sql);

		return $result;
	}	
}
//
?>