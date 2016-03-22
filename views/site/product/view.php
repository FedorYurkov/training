<main>
		
		
		<div class="product-img">
			<img src="/<?php echo Product::getImages($product['img_src'])?>">
		</div>

		<h2><?php echo $product['title'];?></h2>
		
		<div class="product-buy">
			<span><?php echo $product['price'];?> руб.</span> |
			<a href="#" class="add-to-cart" data-id="<?php echo $product['id']; ?>">Купить</a>
		</div>
		
		<div><?php echo $product['text'];?></div>

		
		

		
		
</main>