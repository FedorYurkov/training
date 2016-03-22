<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>
	<h2>Добавить новый товар!</h2>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li> - <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<form action="#" method="post" enctype="multipart/form-data">
		
		<p><label>Название товара: <input type="text" name="title"></label></p>
		
		<p>Категория товара:</p>
		<select name="cat_id">
			<?php foreach ($allCats as $category): ?>
				<option value="<?php echo $category['id']; ?>">
					<?php echo $category['title']; ?>
				</option>
			<?php endforeach; ?>
		</select>

		<p><label>Стоимость товара: <input type="text" name="price"></label></p>

		<p>Описание:</p>
		<textarea name="description"></textarea>

		<p>Полный текст:</p>
		<textarea name="text"></textarea>

		<p>Изображение товара: <input type="file" name="img_src"></p>
		
		<input type="submit" name="submit" value="Создать!">

	</form>

</main>	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>