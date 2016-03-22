<main>
		<h1>КАТАЛОГ ВЕСЬ</h1>			 
		
		<?php foreach ($allProducts as $product): ?> 
			<section>
			
				
				
				<div class="product-img">
					<img src="/<?php echo Product::getImages($product['img_src'])?>" alt="<?php echo $product['title']; ?>" border="1">
				</div>

				<h2><a href="/product/<?php echo $product['id'];?>"><?php echo $product['title']; ?></a></h2>
				 
				 <p><?php echo $product['description'];?></p>
				
				<div class="product-buy">
					<span><?php echo $product['price'];?> руб.</span> |
					<a href="#" class="add-to-cart" data-id="<?php echo $product['id']; ?>">Купить</a>
				</div>
				
			</section>
		<?php endforeach; ?>

</main>