<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>

	<?php if ($msg): ?>
		<div style="color: red;"> <?php echo $msg; ?> </div>
	<?php endif; ?>

	<div style="margin: 5px;"><a href="/admin/product/create" class="back">Добавить новый товар!</a></div>

	<table>
		<tr>
			<th>ID товара</th>
			<th>Название товара</th>
			<th>Цена</th>
			<th></th>
			<th></th>
		</tr>
		<?php foreach ($allProducts as $product): ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><?php echo $product['title']; ?></td>
				<td><?php echo $product['price']; ?></td>  
				<td> <a href="/admin/product/edit/<?php echo $product['id']; ?>" class="back"> Редактировать </a></td>
				<td> <a href="/admin/product/delete/<?php echo $product['id']; ?>" class="back"> Удалить </a> </td>
			</tr>
		<?php endforeach; ?>
	</table>

</main>	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>