<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/sidebar.php'; ?>

<div class="content">
	<div class="content-header">
		<h3>Результати пошуку:</h3>
	</div>
	<ul class="catalog">
		<?php foreach( $products as $product ): ?>
			<li class="catalog-item">
				<a href="/product/<?php echo $product['id']; ?>" class="picture" style="background-image: url(/template/images/product/<?php echo $product['image']; ?>);"></a>
				<a href="/product/<?php echo $product['id']; ?>" class="title">
					<?php echo $product['name']; ?>
				</a>
				<p class="price">
					<?php echo $product['price'] ?>₴
				</p>
			</li>
		<?php endforeach ?>
	</ul>
</div>

<?php include ROOT.'/views/layouts/footer.php'; ?>