<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/sidebar.php'; ?>

<div class="content">
    <div class="content-header">
        <h2>
            <?php echo $productParameters['name']; ?>
        </h2>
    </div>
    <div class="product">
        <div>
            <div class="picture" style="background-image: url(/template/images/product/<?php echo $productParameters['image']; ?>);"></div>
            <div class="product-description">
                <p class="category">
                    <span>Категорія:</span> 
                    <?php foreach ($categories as $categoryItem){
                        if ( $productParameters['category_id'] == $categoryItem['id'] ) {
                            echo $categoryItem['name'];
                            break;
                        }
                    }?>
                </p>
                <p class="sku">
                    <span>SKU#:</span> 
                    <?php echo $productParameters['code']; ?>
                </p>
                <p class="price">
                    <span>Ціна:</span> 
                    <?php echo $productParameters['price']; ?>₴
                </p>
                <button class="edit-product" onclick="$('.new-product-wrapper').addClass('active');">Змінити товар</button>
                <button class="remove-product" onclick="$('.delete-product-wrapper').addClass('active');">Видалити товар</button>
            </div>
        </div>
        <p class="description">
            <span>Опис:</span> 
            <?php echo $productParameters['description']; ?>
        </p>
    </div>
</div>

<?php include ROOT.'/views/product/edit-product.php'; ?>

<?php include ROOT.'/views/product/delete-product.php'; ?>

<?php include ROOT.'/views/layouts/footer.php'; ?>