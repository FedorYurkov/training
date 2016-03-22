<?php
return array(
	// Товар (отдельно взятое предложение);
	'product/([0-9]+)' => 'ProductController/showProduct/$1',

	// Каталог всех предложений;
	'catalog' => 'CatalogController/showIndexCatalog',

	// Категория товаров;
	'category/([0-9]+)' => 'CatalogController/showCategory/$1', 

	// Корзина;
	'cart/delete/([0-9]+)' => 'CartController/delete/$1', // Удаление одного товара;
	'cart/clear' => 'CartController/clear',  // Очистка всей корзины;
	'cart/add/([0-9]+)' => 'CartController/add/$1',
	'cart/buy' => 'CartController/showBuyView',
	'cart' => 'CartController/showCart',

	// Юзер;
	'user/register' => 'UserController/showRegister',
	'user/login' => 'UserController/showLogin',
	'user/logout' => 'UserController/logout',
	'account/edit' => 'UserController/showEdit',
	'account/orders' => 'UserController/showOrders',
	'account' => 'UserController/showAccount',

	// Админ панель - работа с товрами;
	'admin/product/create' => 'adminProductController/showCreate',
	'admin/product/edit/([0-9]+)' => 'adminProductController/showEdit/$1',
	'admin/product/delete/([0-9]+)' => 'adminProductController/showDelete/$1',
	'admin/product' => 'adminProductController/showIndex',

	// Админ панель - работа с категориями;
	'admin/category/create' => 'adminCategoryController/showCreate',
	'admin/category/edit/([0-9]+)' => 'adminCategoryController/showEdit/$1',
	'admin/category/delete/([0-9]+)' => 'adminCategoryController/showDelete/$1',
	'admin/category' => 'adminCategoryController/showIndex',


	// Админпанель;
	'admin' => 'adminController/showIndex',

	// Страница Услуги;	
	'services' => 'SiteController/showServices',

	// Страница О Нас;
	'about' => 'SiteController/showAbout',

	// Страница контактов;
	'contacts' => 'SiteController/showContacts',

	// Главная страница;  
	'index.php'=> 'SiteController/showIndex', 
	'index'=> 'SiteController/showIndex',
	'' => 'SiteController/showIndex',


	);
//
?>