<?php
/*
*Контроллер каталога (категорий товаров);
*/
class CatalogController 
{
	//Метод для вывода основной страницы каталога товаров;
	public function showIndexCatalog()
	{
		$allCats = Category::getAllCategories();
		$allProducts = Product::getAllProducts();

		
		$viewTpl = 'catalog'.DS.'catalog'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}

	//Метод для вывода страницы конкретной категории товаров;
	public function showCategory($categoryId)
	{
		$allCats = Category::getAllCategories();
		$category = Category::getCategoryById($categoryId);
		$productsInCategory = Product::getProductsInCategory($categoryId);

		$viewTpl = 'catalog'.DS.'category'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}
}
//
?>