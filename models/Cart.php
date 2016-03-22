<?php
/**
* Модель Cart - это модель для работы с корзиной;
*/
class Cart
{
	// Метод добавления товара в корзину (содержимое корзины хранится в сессии в виде масива со значениями (productId=>quantity) );
	public static function addProduct($productId)
	{
		// Массив подуктов в корзине:
		$productsInCart = array();

		$productId = intval($productId);

		//Если в сессии уже хранятся товары (добавлены ранее)
		if (isset($_SESSION['products'])) {
		
			$productsInCart = $_SESSION['products'];
		}

		if (array_key_exists($productId, $productsInCart)) {
			// Если товар уже есть - увеличим его кол-во на 1;
			$productsInCart[$productId]++;
		} else {
			// Если нет - добавим его в кол-ве 1шт;
			$productsInCart[$productId] = 1;
		}

		// Запишем новое содержимое корзины в сессию; 
		$_SESSION['products'] = $productsInCart;

		// Возвращаем ко-во товаров в корзине;
		return self::countProducts();
	}

	// Метод удаляет конкретный товар из корзины;
	public static function deleteProduct($productId)
	{
		// Получаем товары в корзине;
		$productsInCart = self::getProductsInCart();
		// Удаляем ненужный товар;
		unset($productsInCart[$productId]);
		// Записываем в измененный список товаров;
		$_SESSION['products'] = $productsInCart;
	}

	// Метод удаляет все товары из корзины;
	public static function deleteAllProducts()
	{
		if (isset($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	}

	// Метод подсчета кол-ва товаров в корзине;
	public static function countProducts()
	{
		$count = 0;

		// Если в сессии есть массив с продуктами из корзины то посчитаем их;
		if (isset($_SESSION['products'])) {
			
			foreach ($_SESSION['products'] as $productId => $quantity) {
				$count = $count + $quantity;
			}
		}

		return $count;		
	}

	// Метод возвращает из сессии массив с продуктами в корзине;
	public static function getProductsInCart()
	{
		if (isset($_SESSION['products'])) {
			return $_SESSION['products'];
		}
		return false;
	}

	// Метод возвращает общую стоимость всех товаров в корзине;
	public static function getTotalCartPrice()
	{
		$totalCartPrice = 0;
		// Получаем массив с продуктами вида(id=>кол-во)
		$productsInCart = self::getProductsInCart();
		// Из него получаем массив всех id
		$productsIds = array_keys($productsInCart);
		
		foreach ($productsIds as $id) {
				// Получим данные о продукте;
				$product = Product::getProductById($id);

				$totalCartPrice +=$product['price'] * $productsInCart[$id]; 
			}
		return $totalCartPrice;
	}
}
//
?>