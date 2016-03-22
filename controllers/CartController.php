<?php
/**
* Контроллер корзины
*/
class CartController
{
	// Метод вывода страницы корзины;
	public function showCart()
	{
		$productsInCart = false;

		$allCats = Category::getAllCategories();

		// Получим из сессии выбранные в корзину товары (массив (id=>кол-во));
		$productsInCart = Cart::getProductsInCart();

		// Если в корзине есть товары
		if ($productsInCart) {
			// Получим массив всех ID товаров;
			$productsIds = array_keys($productsInCart);

			$products = array();

			// Общая сумма в корзине;
			$totalCartPrice = 0;

			// Для каждого ID товара
			foreach ($productsIds as $key => $productId) {
				// Получим данные о продукте;
				$products[$key] = Product::getProductById($productId);

				// Получим его кол-во в корзине;
				$products[$key]['quantity'] = $productsInCart[$productId];
				// Его стоимость в корзине;
				$products[$key]['total_price'] = $products[$key]['quantity']*$products[$key]['price'];
				
				// Прибавим его стоимость к общей стоимости всех товаров;
				$totalCartPrice = $totalCartPrice + $products[$key]['total_price'];
			}
		}

		$viewTpl = 'cart'.DS.'cart_view'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}

	// Метод вывода страницы оформления покупки;
	public function showBuyView()
	{
		$productsInCart = Cart::getProductsInCart();

		// Если товаров нет - перенаправляем пользователя на главную
		if ($productsInCart == false) {
			header("Location: /");
		}

		$allCats = Category::getAllCategories();

		// Общая стоимость товаров в корзине;
		$totalCartPrice = Cart::getTotalCartPrice();
		// Общее ко-во товаров в корзине;
		$totalCartQuantity = Cart::countProducts();

		// Переменная, которая будет содержать строку с результатом оформления заказа;
		$result = '';

		// Проверим авторизирован ли юзер, если да то получим его ID;
		$userId = User::checkAuth();
		
		if ($userId) {
			// Если авторизирован - получим его данные;
			$user = User::getUserById($userId);

			$userPhone = false;

			// Если форма отправлена;
			if (isset($_POST['submit'])){
				$userPhone = $_POST['userPhone'];
				$delivery = $_POST['delivery'];

				// Переменная для хранения ошибок;
				$errors = false;

				// Проверим корректность введенных данных;
				if (!User::validateUserPhone($userPhone)) {
					$errors[] = 'Некорректный ввод телефона!';
				}

				if ($errors == false) {
					// Если ошибок нет - сохраняем данные о заказе в БД
					$save = Order::saveOrder($userId, $user['name'], $userPhone, $delivery, $productsInCart, $totalCartPrice);
					
					if ($save) {
						// Если получилось сохранить;
						$result = 'Ваш заказ оформлен!';
						
						//Очищаем корзину;
						Cart::deleteAllProducts();
						/* Дальше можно например послать письма по email при помощи mail(): 
						* покупателю(об успешном совершении заказа) и админу(о новом заказе);
						*/
					} else {
						// Если не получилось (напрмиер в случае траблов с БД);
						$result = 'Произошла ошибка. Попробуйте повторить попытку позже или сообщите в тех. поддержку!';
					}					
				}
			}
		
		} else { 
			// Если не авторизирован;
			$result = 'Для оформления заказа необходимо выполнить процедуру входа на сайт!';
		}

		$viewTpl = 'cart'.DS.'buy_view';
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');
		
		return true;
	}

	// Метод вывода для асинхронного добовления товара в корзину;
	public function add($productId)
	{
		// Добовляем товар в корзину и выводим результат (общее кол-во товаров в корзине)
		echo Cart::addProduct($productId);

		return true;
	}

	// Метод вывода для удаления одного товара из корзины;
	public function delete($productId)
	{
		// Удалаем товар;
		Cart::deleteProduct($productId);
		// И перенаправляем снова  в корзину;
		header("Location: /cart");	
	}

	// Метод вывода для очистки всей корзины;
	public function clear()
	{
		Cart::deleteAllProducts();
		header("Location: /cart");
	}
}
//
?>