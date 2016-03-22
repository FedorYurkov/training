<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'header-admin.php');
?>

<main>
	<h2>Подтвердите удаление категории с Id <?php echo $categoryId?></h2>

	<form method="post" acttion="#">
		<input type="submit" name="submit" value="Удалить!">
	</form>

</main>	 	

<?php
include (ROOT.DS.'views'.DS.'admin'.DS.'layouts-admin'.DS.'footer-admin.php');
?>