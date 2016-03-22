<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>
	<h2>Добавить новую категорию!</h2>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li> - <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<form action="#" method="post">
		
		<p><label>Название категорииа: <input type="text" name="title"></label></p>
		
		<p>Полный текст:</p>
		<textarea name="text"></textarea>

		<br>		
		<input type="submit" name="submit" value="Создать!">

	</form>

</main>	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>