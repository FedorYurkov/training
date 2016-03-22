<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>

	<?php if ($msg): ?>
		<div style="color: red;"> <?php echo $msg; ?> </div>
	<?php endif; ?>

	<div style="margin: 5px;"><a href="/admin/category/create">Добавить новую категорию!</a></div>

	<table>
		<tr>
			<th>ID Категории</th>
			<th>Название категории</th>
			<th></th>
			<th></th>
		</tr>
		<?php foreach ($allCats as $category): ?>
			<tr>
				<td><?php echo $category['id']; ?></td>
				<td><?php echo $category['title']; ?></td>
				<td> <a href="/admin/category/edit/<?php echo $category['id']; ?>" class="back"> Редактировать </a></td>
				<td> <a href="/admin/category/delete/<?php echo $category['id']; ?>" class="back"> Удалить </a> </td>
			</tr>
		<?php endforeach; ?>
	</table>

</main>	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>