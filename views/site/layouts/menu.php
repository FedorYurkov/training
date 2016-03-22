<div id="menu">
	<ul>
		<?php foreach ($allCats as $cat): ?>		
			<li><a href="/category/<?php echo $cat['id']; ?>"> <?php echo $cat['title']; ?> </a></li>
		<?php endforeach; ?>
	</ul>
</div>