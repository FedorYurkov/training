<main>

	<?php if ($productsInCart): ?>
		<h2>Список выбраных товаров:</h2>

		<table class="cart-list">
			<tr>
				<th> ID товара </th>
				<th> Наименование </th>
				<th> Количество, шт </th>
				<th> Цена, руб </th>
				<th> Общая стоимость, руб </th>				
				<th> Удалить </th>
			</tr>
			
			<?php foreach ($products as $product): ?>
			
			<tr>
				<td> <?php echo $product['id']; ?> </td>
				<td> <a href="/product/<?php echo $product['id'];?>"> <?php echo $product['title']; ?> </a> </td>
				<td> <?php echo $product['quantity']; ?> </td>
				<td> <?php echo $product['price']; ?> </td>
				<td> <?php echo $product['total_price']; ?></td>				
				<td> <a href="/cart/delete/<?php echo $product['id'];?>">X</a> </td>
			</tr>
			
			<?php endforeach; ?>

			<tr>
				<td colspan="4"> Общая стоимость: </td>
				<td> <?php echo $totalCartPrice; ?> </td>				
				<td> </td>
			</tr>

		</table>

		<div class="product-buy">
			<a href="/cart/clear">Очистить корзину!</a> | <a href="/cart/buy">Купить!</a>
		</div>
				  
	<?php else: ?>
		<p>Вы не выбрали еще не одного товара!</p>		
	<?php endif; ?>

		<div><a href="/catalog" class="back">Вернуться в каталог товаров.</a></div>
</main>	