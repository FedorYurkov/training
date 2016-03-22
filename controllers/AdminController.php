<?php
/**
* Контроллер для работы с админ панелью;
*/
class AdminController
{
	// Метод вывода главной страницы админпанели;
	public function showIndex()
	{

		User::isAdmin();
		
		require_once(ROOT.DS.'views'.DS.'admin'.DS.'index.php');
		return true;
	}

}
?>