<main>
		<h1>Редактирование данных</h1>

		<?php if ($result): ?>
			<?php echo ($result); ?>			
		<?php else: ?>
		
			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li> - <?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<form action="" method="post">
				<label>Имя: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Имя"></label> <br><br>
				<!-- <label>E-mail: <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mail"></label> <br><br> -->
				<!-- <label>Пароль: <input type="password" name="password" value="" placeholder="Пароль"></label> <br><br> -->
				<input type="submit" name="submit" value="Сохранить">
			</form>
		
		<?php endif; ?>

		<p><a href="/account">Вернуться в кабинет</a></p>
</main>