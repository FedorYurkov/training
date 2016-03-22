<?php
/**
* Класс Order - модель для работы с заказами
*/
class Order
{
	//Метод сохранения заказа;
	public static function saveOrder($userId, $userName, $userPhone, $delivery, $productsInCart, $orderPrice)
	{
		
		$products = json_encode($productsInCart);

		$db = Db::getConnection();
		$sql ="INSERT INTO `order_list` (`user_id`, `user_name`, `user_phone`, `delivery`, `products`, `order_price`) VALUES (
										".$userId.",
										'".$db->real_escape_string($userName)."',
										'".$db->real_escape_string($userPhone)."',
										'".$db->real_escape_string($delivery)."',
										'".$db->real_escape_string($products)."',
										'".$db->real_escape_string($orderPrice)."');";
		$result = $db->query($sql);
		return $result;	
	}

	// Метод получает данные о заказах конкретного пользователя;
	public static function getOrdersByUserId($userId)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM `order_list` WHERE `user_id`=".$userId.";";

		$result = $db->query($sql);
		$result = $result->fetch_all(MYSQLI_ASSOC);

		return $result;

	}
}
//
?>