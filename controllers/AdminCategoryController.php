<?php
/**
* Контроллер для работы с админ панелью;
*/
class AdminCategoryController
{
	// Метод вывода страницы всех категорий;
	public function showIndex()
	{
		// Проверка прав доступа;
		User::isAdmin();

		$allCats = Category::getAllCategories();
		
		$msg = false;

		if (isset($_SESSION['msg'])){
			$msg = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'category-admin'.DS.'category-list.php');
		return true;
	}

	// Метод вывода страницы удаления категории;
	public function showDelete($categoryId)
	{
		// Проверка прав доступа;
		User::isAdmin();

		if (isset($_POST['submit'])) {
			// Если форма отправлена - удалим товар;
			$delete = Category::deleteCategoryById($categoryId);

			if ($delete) {
				// Запишем в сессию результат
				$_SESSION['msg'] = 'Категория успешно удален!';
			} else {
				$_SESSION['msg'] = 'Ошибка удаления!';
			}

			// И перенаправим на страницу с товарами;
			header("Location: /admin/category");
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'category-admin'.DS.'delete.php');
		return true;
	}

	// Метод работы страницы создания категории;
	public function showCreate()
	{
		// Проверка прав доступа;
		User::isAdmin();

		$data = array();

		if (isset($_POST['submit'])) {
			
			$data['title'] = $_POST['title'];
			$data['text'] = $_POST['text'];

			$errors = false;
			// Далее можно валидировать значения
			if (!isset($data['title']) || empty($data['title'])) {
				// Например:
				$errors[] = 'Заполните поле название товара!';
				// И т.д.;
			}

			if ($errors == false) {
				$create = Category::createCategory($data);

				if ($create) {
				// Запишем в сессию результат
					$_SESSION['msg'] = 'Категория успешно создана!';
				} else {
					$_SESSION['msg'] = 'Ошибка создания новой категории!';
				}

				// И перенаправим на страницу с товарами;
				header("Location: /admin/category");
			}
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'category-admin'.DS.'create.php');
		return true;
	}

	// Метод работы страницы редактирования категории;
	public function showEdit($categoryId)
	{
		// Проверка прав доступа;
		User::isAdmin();

		$category = Category::getCategoryById($categoryId);

		// Массив для новых данных;
		$data = array();

		if (isset($_POST['submit'])) {
			$data['title'] = $_POST['title'];
			$data['text'] = $_POST['text'];

			$errors = false;
			// Далее можно валидировать значения
			if (!isset($data['title']) || empty($data['title'])) {
				// Например:
				$errors[] = 'Заполните поле название товара!';
				// И т.д.;
			}

			if ($errors == false) {
				$edit = Category::editCategory($categoryId, $data);

				if ($edit) {
				// Запишем в сессию результат
					$_SESSION['msg'] = 'Изменения успешно сохранены!';
				} else {
					$_SESSION['msg'] = 'Ошибка редактирования данных товара!';
				}

				// И перенаправим на страницу с товарами;
				header("Location: /admin/category");
			}
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'category-admin'.DS.'edit.php');
		return true;
	}
}
//
?>