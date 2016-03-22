<main>
	<h2>Авторизация на сайте</h2>

	<?php if (isset($errors) && is_array($errors)): ?>
		<ul>
			<?php foreach ($errors as $error): ?>
				<li> - <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<form action="#" method="post">
		<label>E-mail: <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mail"></label> <br><br>
		<label>Пароль: <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Пароль"></label> <br><br>
		<input type="submit" name="submit" value="Авторизоваться">
	</form>

	
	<div class="expl">
		Если Вы еще не зарегистрированы у нас на сайте, то необходимо пройти простую процедуру регистрации.</br>
		<a href="/user/register" class="back">Посетить страницу регистрации?</a>
	</br>

</main>