<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>
	<h2>Редактировать товар!</h2>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li> - <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<form action="#" method="post" enctype="multipart/form-data">
		
		<p><label>Название товара: <input type="text" name="title" value="<?php echo $product['title']; ?>"></label></p>
		
		<p>Категория товара:</p>
		<select name="cat_id">
			<?php foreach ($allCats as $category): ?>
				<option value="<?php echo $category['id']; ?>" <?php if($product['cat_id'] == $category['id']) echo ' selected="selected"'; ?>>
					<?php echo $category['title']; ?>
				</option>
			<?php endforeach; ?>
		</select>

		<p><label>Стоимость товара: <input type="text" name="price" value="<?php echo $product['price']; ?>"></label></p>

		<p>Описание:</p>
		<textarea name="description"><?php echo $product['description']; ?></textarea>

		<p>Полный текст:</p>
		<textarea name="text"><?php echo $product['text']; ?></textarea>

		<p>
			Изображение товара: 
			<img src="/<?php echo Product::getImages($product['img_src'])?>">
			<input type="file" name="img_src">
		</p>
		
		<input type="submit" name="submit" value="Сохранить!">

	</form>

</main>	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>