<main>
		
		<h3>Заказы пользователя <?php echo $user['name'] ;?>:</h3>
		
		<?php if (isset($msg)):?>
			<p><?php echo $msg;?></p>
		<?php endif;?>


		<?php if (isset($orders)):?>			
			<?php foreach ($orders as $order): ?>
				<p>Дата: <?php echo $order['date'];?></p>
				<p>Сумма: <?php echo $order['order_price'];?></p>
				<hr>
			<?php endforeach; ?>
		<?php endif;?>
		
</main>