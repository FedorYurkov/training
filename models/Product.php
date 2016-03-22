<?php
/**
* Класс Product - это модель для работы с товарами(продуктами);
*/
class Product
{
	// Метод возврашает массив с данными всех товаров;
	public static function getAllProducts()
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `product`;";

		$result = $db->query($sql);
		$result = $result->fetch_all(MYSQLI_ASSOC);

		return $result;
	}

	// Метод возврашает массив с данными одного товара;
	public static function getProductById($id)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `product` WHERE `id`=".intval($id).";";

		$result = $db->query($sql);
		$result = $result->fetch_array(MYSQLI_ASSOC);

		return $result;
	}

	// Метод возврашает массив всех товаров заданной категории;
	public static function getProductsInCategory($categoryId)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `product` WHERE `cat_id`=".intval($categoryId)." ORDER by `id`;";

		$result = $db->query($sql);
		$result = $result->fetch_all(MYSQLI_ASSOC);

		return $result;
	}

	// Метод удаляет указаный товар;
	public static function deleteProductById($id)
	{
		$db = Db::getConnection();

		$sql = "DELETE FROM `product` WHERE `id`=".intval($id).";";

		$result = $db->query($sql);

		return $result;
	}

	// Метод редактирует указанный товар, data - массив новых данных;
	public static function editProduct($id, $data)
	{
		$db = Db::getConnection();

		$sql = "UPDATE `product` SET 
									`cat_id` = ".intval($data['cat_id']).",
									`title` = '".$db->real_escape_string($data['title'])."',
									`price` = '".$db->real_escape_string($data['price'])."',
									`description` = '".$db->real_escape_string($data['description'])."',
									`text` = '".$db->real_escape_string($data['text'])."',
									`img_src` = '".$db->real_escape_string($data['img_src'])."'
									WHERE `id`=".intval($id).";";
		$result = $db->query($sql);

		return $result;
	}

	// Метод создает новый товар, data - массив данных;
	public static function createProduct($data)
	{
		$db = Db::getConnection();

		$sql = "INSERT INTO `product` (`cat_id`, `title`, `price`, `description`, `text`, `img_src`)
							VALUES (".intval($data['cat_id']).",
									'".$db->real_escape_string($data['title'])."',
									'".$db->real_escape_string($data['price'])."',
									'".$db->real_escape_string($data['description'])."',
									'".$db->real_escape_string($data['text'])."',
									'".$db->real_escape_string($data['img_src'])."');";   
		$result = $db->query($sql);

		return $result;
	}

	// Метод получения изображения
	public static function getImages($img_src)
	{
		// Путь к стандартной картинке-заглушке 'нет изображения';
		$no_img = 'images'.DS.'no-image.png';

		if (file_exists(ROOT.DS.$img_src) && is_file(ROOT.DS.$img_src)) {
			// Если существует файл по пути, переданному этой функции, то вернуть этот же путь;
			return ($img_src);
		}
		// Если такого файла нет, то вернуть путь к стандартной картинке-заглушке;
		return $no_img;
	}
}
//
?>