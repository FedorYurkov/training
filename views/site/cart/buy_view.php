<main>
	
	<?php if ($result): ?>
		<div><?php echo $result; ?></div>
	<?php else: ?>
		
		<div> Подробности заказа: 
			<span> Всего товаров: <?php echo $totalCartQuantity;?> </span> 
			<span> Общая сумма: <?php echo $totalCartPrice; ?> </span>
		</div>
		<br><hr>

		<div> Ваши контактные данные:
			<p>Имя: <?php echo $user['name'] ;?> </p>
			<p>Email: <?php echo $user['email'] ;?> </p>
			<p><a href="/account/edit">Редактировать</a></p>
		</div>
		<br><hr>

		<?php if (isset($errors) && is_array($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li> - <?php echo $error; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<form action="#" method="post">
			<label>*Контактный телефон: <input type="text" name="userPhone" value="<?php echo $userPhone; ?>"> </label><br>
			<p> Выберите желаемый способ доставки: 
				<select name="delivery">
					<option value="1" selected>Самовывоз</option>
					<option value="2">Доставка курьером</option>
				</select>
			</p>
			<input type="submit" name="submit" value="Оформить">
		</form>


	<?php endif; ?>

</main>	
