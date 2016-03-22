<?php
/**
* Класс User - это модель для работы с пользователями;
*/
class User
{
	// Метод регистрации пользователя;
	public static function register($name, $email, $password)
	{
		$db = Db::getConnection();

		$sql = "INSERT INTO `users` (`name`, `email`, `password`) 
							VALUES ('".$db->real_escape_string($name)."',
									'".$db->real_escape_string($email)."',
									'".md5($db->real_escape_string($password))."'
									);";
		$result = $db->query($sql);

		return $result;
	} 

	// Метод редактирования имени пользователя;
	public static function editName($id, $name)
	{
		$db = Db::getConnection();

		$sql = "UPDATE `users` SET `name`='".$db->real_escape_string($name)."' WHERE `id`='".$id."';";
		$result = $db->query($sql);
		
		return $result;
	}

	/* Метод проверки имени пользователя 
	* (в данном случае проверим только длину);
	*/
	public static function validateUserName($name)
	{
		if (strlen($name)>=2) {
			return true;
		}
		return false;
	}

	/* Метод проверки пароля пользователя 
	* (в данном случае проверяется только длина,
	* но лучше еще добавить рег. выражение на разрешенные символы);
	*/
	public static function validateUserPassword($password)
	{
		if (strlen($password) >= 4) {
			return true;
		}
		return false;
	}

	// Метод проверки email пользователя;
	public static function validateUserEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	// Метод проверки телефона пользователя;
	public static function validateUserPhone($phone)
	{
		if (strlen($phone) == 11) {
			return true;
		}
		return false;
	}

	// Метод проверяет зареген ли уже такой email(а значит и юзер);
	public static function chekEmailExist($email)
	{
		$db = Db::getConnection();

		$sql = "SELECT `email` FROM `users` WHERE `email`='".$db->real_escape_string($email)."';";
		$result = $db->query($sql);
		$result = $result->fetch_all(MYSQLI_ASSOC);

		if ($result) {
			return true;
		} else {
			return false;
		}
		
	}

	// Метод проверки - Существует ли пользователь с такими Email и Паролем? Если да - то возвращает его ID;
	public static function chekUserExist($email, $password)
	{
		$db = Db::getConnection();

		$sql = "SELECT `id` FROM `users` WHERE
							 `email`='".$db->real_escape_string($email)."' AND
							 `password`='".md5($db->real_escape_string($password))."';";
		$result = $db->query($sql);

		$result = $result->fetch_array(MYSQLI_ASSOC);

		$userId = $result['id'];
		
		return $userId;	
	}

	// Метод получения данных пользователя по его Id;
	public static function getUserById($id)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `users` WHERE `id`='".intval($id)."';";
		
		$result = $db->query($sql);

		$result = $result->fetch_array(MYSQLI_ASSOC);
		
		return $result;	
	}

	// Метод записывает ID пользователя в сессию;
	public static function authorisation($userId)
	{
		$_SESSION['userId'] = $userId;
	}

	// Метод проверяет авторизирован ли пользователь? Если да то возвращает его ID;
	public static function checkAuth()
	{
		if (isset($_SESSION['userId'])) {
			return ($_SESSION['userId']);
		} else {
			return false;
		}		
	}

	// Метод проверяет - является ли пользователь админом?
	public static function isAdmin()
	{
		$userId = self::checkAuth();

		if (!$userId) {
			// Если пользователь не авторизован - отправим на страницу входа;
			header("Location: /user/login");
		} else {
			$user = self::getUserById($userId);
			// Если авторизован - получим его тип.
			if ($user['type'] === 'admin') {
				return true;
			}
			die('Доступ запрещен!');
		}
		
	}
}
//
?>