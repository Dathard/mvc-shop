<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/sidebar.php'; ?>

<div class="content">
	<div class="content-header">
		<select id="sorting" class="select">
			<option data-url="<?php echo ($sort ? '' : $categoryId.'/'); ?>sort=novelty"
				<?php if ($sort == 'novelty') echo 'selected'; ?> >
				Новинки
			</option>
			<option data-url="<?php echo ($sort ? '' : $categoryId.'/'); ?>sort=cheap" 
				<?php if ($sort == 'cheap') echo 'selected'; ?>>
				Від дешевих до дорогих
			</option>
			<option data-url="<?php echo ($sort ? '' : $categoryId.'/'); ?>sort=expensive" 
				<?php if ($sort == 'expensive') echo 'selected'; ?>>
				Від дорогих до дешевих
			</option>
			<option data-url="<?php echo ($sort ? '' : $categoryId.'/'); ?>sort=alphabet" 
				<?php if ($sort == 'alphabet') echo 'selected'; ?>>
				По алфавіту
			</option>
		</select>
	</div>
	<ul class="catalog">
		<li class="new-product catalog-item" title="Створити новий товар" onclick="$('.new-product-wrapper').addClass('active');">+</li>
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
	
	<?php echo $pagination->get(); ?>

</div>

<?php include ROOT.'/views/product/new-product.php' ?>

<?php include ROOT.'/views/layouts/footer.php'; ?>