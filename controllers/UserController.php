<?php
/**
* Контроллер для работы с пользователем;
*/
class UserController
{
	// Метод для работы со страницей регистрации;
	public function showRegister()
	{
		$allCats = Category::getAllCategories();

		$name = false;
		$email = false;
		$password = false;
		$result = false;

		//Если форма отправлена, получаем данные;
		if(isset($_POST['submit'])) {
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Переменная для хранения ошибок;
			$errors = false;
			
			// Проверим корректность введенных данных;
			if(!User::validateUserName($name)) {
				$errors[] = 'Некорректный ввод имени!';
			}

			
			if(!User::validateUserPassword($password)) {
				$errors[] = 'Некорректный ввод пароля!';
			}
			

			if(!User::validateUserEmail($email)) {
				$errors[] = 'Некорректный ввод E-mail!';
			}

			if(User::chekEmailExist($email)) {
				$errors[] = 'Пользователь с таким E-mail уже существует!';
			}

			//Если ошибок нет - зарегистрируем пользователя
			if($errors == false) {
				
				$register = User::register($name, $email, $password);

				if ($register) {
					// Если получилось зарегистрироваться;
					$result = 'Вы зарегистрированы!  На ваш email придет письмо  с активацией';
					// Дальше можно написать код отправки письма по email при помощи mail()

				} else {
					// Если не получилось зарегестрироваться (напрмиер в случае траблов с БД);
					$result ='Произошла ошибка при регистрации. Попробуйте повторить попытку позже или сообщите в тех. поддержку!';
				}
			}
		}

		$viewTpl = 'user'.DS.'register'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');
		return true;
	}

	// Метод для работы со страницей входа на сайт;
	public function showLogin()
	{
		$allCats = Category::getAllCategories();

		$email = false;
		$password = false;

		if(isset($_POST['submit'])) {

			$email = $_POST['email'];
			$password = $_POST['password'];

			//Проверим корректность введенных данных;
			$errors = false;

			if(!User::validateUserPassword($password)) {
				$errors[] = 'Некорректный ввод пароля!';
			}

			if(!User::validateUserEmail($email)) {
				$errors[] = 'Некорректный ввод E-mail!';
			}

			/* Проверим - Существует ли пользователь с такими данными?
			* (Если Да - то получим его ID); 
			*/
			$userId = User::chekUserExist($email, $password);

			if(!$userId) {
				// Если данные не правильные;
				$errors[] = 'Такого пользователя не существует! Возможно вы  ввели неправильные данные!';
			} else {
				// Если все верно - то авторизируем пользователя;
				User::authorisation($userId);
				header("Location: /account");
			}
		} 

		$viewTpl = 'user'.DS.'login'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}

	// Метод удаляет данные о пользователе из сессии;
	public function logout()
	{
		session_destroy();
		header("Location: /");
	}

	// Метод отображения кабинета пользователя;
	public function showAccount()
	{
		// Проверим авторизирован ли пользователь;
		$userId = User::checkAuth();

		$allCats = Category::getAllCategories();

		if($userId) {
			// Если Да, то покажем кабинет;
			$user = User::getUserById($userId);

			$viewTpl = 'user'.DS.'account'; 
			require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		} else {
			// Если Нет, то перенаправим на страницу авторизации;
			header("Location: /user/login");
		}

		return true;
	}

	/* Метод отображает страницу редактирования данных юзера;
	* Пока сделал только для имени, надо как-нибудь однажды доделать с email и поролем;
	*/
	public function showEdit()
	{
		// Проверим авторизирован ли пользователь;
		$userId = User::checkAuth();

		

		if($userId) {
			// Если да - получим его данные; 
			$user = User::getUserById($userId);
			$name = $user['name'];
			
			$allCats = Category::getAllCategories();
						
			$result = false;

			//Если форма отправлена, получаем данные;
			if(isset($_POST['submit'])) {
				$name = $_POST['name'];
				
				// Переменная для хранения ошибок;
				$errors = false;
				// Проверим корректность введенных данных;
				if(!User::validateUserName($name)) {
					$errors[] = 'Некорректный ввод имени!';
				}

				//Если ошибок нет - редактируем данные пользователя
				if($errors == false) {
					$edit = User::editName($userId, $name);

					if ($edit) {
						// Если получилось;
						$result = 'Данные успешно изменены!';
					} else {
						// Если не получилось отредактировать (напрмиер в случае траблов с БД);
						$result ='Произошла ошибка при изменении данных. Попробуйте повторить попытку позже или сообщите в тех. поддержку!';
					}
				}
			}
			
			$viewTpl = 'user'.DS.'edit'; 
			require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		} else {
			// Если пользователь не авторизован, то перенаправим на страницу авторизации;
			header("Location: /user/login");
		}

		return true;
	}

	// Метод вывода страницы заказов юзера;
	public function showOrders()
	{
		// Проверим авторизирован ли пользователь;
		$userId = User::checkAuth();

		if ($userId) {
			
			$allCats = Category::getAllCategories();

			$user = User::getUserById($userId);

			$orders = Order::getOrdersByUserId($userId);

			if (!$orders) {
				$msg = 'У Вас нет оформленных заказов!';
			} 

			$viewTpl = 'user'.DS.'orders'; 
			require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');
		} else {
			// Если пользователь не авторизован, то перенаправим на страницу авторизации;
			header("Location: /user/login");
		}
		return true;
	}
}
//
?>