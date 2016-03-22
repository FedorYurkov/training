<?php
/**
* Кoнтроллер общих страниц сайта;
*/
class SiteController
{
	// Метод вывода Главной страницы;	
	public function showIndex()
	{
		$allCats = Category::getAllCategories();

		$viewTpl = 'main'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}

	// Метод вывода страницы Услуги;	
	public function showServices()
	{
		$allCats = Category::getAllCategories();

		$viewTpl = 'services'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}
	
	// Метод вывода страницы О Нас;	
	public function showAbout()
	{
		$allCats = Category::getAllCategories();

		$viewTpl = 'about'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}

	// Метод вывода страницы Контакты;	
	public function showContacts()
	{
		$allCats = Category::getAllCategories();

		$viewTpl = 'contacts'; 
		require_once(ROOT.DS.'views'.DS.'site'.DS.'index.php');

		return true;
	}
}
//
?>