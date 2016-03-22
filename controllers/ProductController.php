<?php
/*
*Контроллер каталогов;
*/
class ProductController 
{
	// Метод для вывода страницы с одним товаром;
	public function showProduct($productId)
	{
		$allCats = Category::getAllCategories();
		$product = Product::getProductById($productId);
		
		$viewTpl = 'product'.DS.'view'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}
}
//
?>