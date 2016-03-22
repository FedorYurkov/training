<aside>
	<ul>
		<li><a href="/cart">Корзина (<span id="cart-count"><?php echo Cart::countProducts(); ?></span>)</a></li>
		<?php if(!User::checkAuth()): ?>
			<li><a href="/user/login">Вход</a></li>
		<?php else: ?>
			<li><a href="/account">Кабинет</a></li>
			<li><a href="/user/logout">Выход</a></li>
		<?php endif;?>
	</ul>
</aside>