<?php
/**
* Контроллер для работы с админ панелью;
*/
class AdminProductController
{
	// Метод вывода страницы всех товаров;
	public function showIndex()
	{
		// Проверка прав доступа;
		User::isAdmin();

		$allProducts = Product::getAllProducts();

		$msg = false;

		if (isset($_SESSION['msg'])){
			$msg = $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		
		require_once(ROOT.DS.'views'.DS.'admin'.DS.'product-admin'.DS.'product-list.php');
		return true;
	}

	// Метод вывода страницы удаления товара;
	public function showDelete($productId)
	{
		// Проверка прав доступа;
		User::isAdmin();

		if (isset($_POST['submit'])) {
			// Если форма отправлена - удалим товар;
			$delete = Product::deleteProductById($productId);

			if ($delete) {
				// Запишем в сессию результат
				$_SESSION['msg'] = 'Товар успешно удален!';
			} else {
				$_SESSION['msg'] = 'Ошибка удаления!';
			}
			
			// И перенаправим на страницу с товарами;
			header("Location: /admin/product");
		}
		
		require_once(ROOT.DS.'views'.DS.'admin'.DS.'product-admin'.DS.'delete.php');
		return true;
	}

	// Метод работы страницы создания товара;
	public function showCreate()
	{
		// Проверка прав доступа;
		User::isAdmin();

		$allCats = Category::getAllCategories();

		$data = array();

		if (isset($_POST['submit'])) {
			$data['cat_id'] = $_POST['cat_id'];
			$data['title'] = $_POST['title'];
			$data['price'] = $_POST['price'];
			$data['description'] = $_POST['description'];
			$data['text'] = $_POST['text'];

			// Если передан файл;
			if (!empty($_FILES['img_src']['tmp_name'])) {
				// Относительный путь, который будет хранится в БД;
				$path = 'images'.DS.'product-images'.DS.$_FILES['img_src']['name'];
				// Полный путь, куда его надо переместить;
				$destination = ROOT.DS.$path;
				// Переместим файл и запишем в переменную результат перемещения (true или false)
				$move = move_uploaded_file($_FILES['img_src']['tmp_name'], $destination);				
			}
				
			if (isset($move) && $move) {
				// Если файл удалось переместить, то запишем путь к нему;
				$data['img_src']=$path;
			} else {
				$data['img_src'] = '';
			}

			$errors = false;
			// Далее можно валидировать значения
			if (!isset($data['title']) || empty($data['title'])) {
				// Например:
				$errors[] = 'Заполните поле название товара!';
				// И т.д.;
			}

			if ($errors == false) {
				$create = Product::createProduct($data);

				if ($create) {
				// Запишем в сессию результат
					$_SESSION['msg'] = 'Товар успешно создан!';
				} else {
					$_SESSION['msg'] = 'Ошибка создания нового товара!';
				}
			
				// И перенаправим на страницу с товарами;
				header("Location: /admin/product");
			}			
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'product-admin'.DS.'create.php');
		return true;
	}

	// Метод работы страницы редактирования товара;
	public function showEdit($productId)
	{
		// Проверка прав доступа;
		User::isAdmin();

		$product = Product::getProductById($productId);

		$allCats = Category::getAllCategories();

		// Массив для новых данных;
		$data = array();

		if (isset($_POST['submit'])) {
			$data['cat_id'] = $_POST['cat_id'];
			$data['title'] = $_POST['title'];
			$data['price'] = $_POST['price'];
			$data['description'] = $_POST['description'];
			$data['text'] = $_POST['text'];
			
			// Если передан файл;
			if (!empty($_FILES['img_src']['tmp_name'])) {
				// Относительный путь, который будет хранится в БД;
				$path = 'images'.DS.'product-images'.DS.$_FILES['img_src']['name'];
				// Полный путь, куда его надо переместить;
				$destination = ROOT.DS.$path;
				// Переместим файл и запишем в переменную результат перемещения (true или false)
				$move = move_uploaded_file($_FILES['img_src']['tmp_name'], $destination);				
			}
				
			if (isset($move) && $move) {
				// Если файл удалось переместить, то запишем путь к нему;
				$data['img_src']=$path;
			} else {
				$data['img_src'] = $product['img_src'];
			}

			$errors = false;
			// Далее можно валидировать значения
			if (!isset($data['title']) || empty($data['title'])) {
				// Например:
				$errors[] = 'Заполните поле название товара!';
				// И т.д.;
			}

			if ($errors == false) {
				$edit = Product::editProduct($productId, $data);

				if ($edit) {
				// Запишем в сессию результат
					$_SESSION['msg'] = 'Изменения успешно сохранены!';
				} else {
					$_SESSION['msg'] = 'Ошибка редактирования данных товара!';
				}
			
				// И перенаправим на страницу с товарами;
				header("Location: /admin/product");
			}
		}

		require_once(ROOT.DS.'views'.DS.'admin'.DS.'product-admin'.DS.'edit.php');
		return true;
	}
}
//
?>