<div class="new-product-wrapper">
    <div class="new-product">
        <h2>Зміна параметрів товару
            <span title="Закрити" onclick="$('.new-product-wrapper').removeClass('active');">Х</span>
        </h2>
        <form id="edit-product" action="/edit-product" method="post" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="id" value="<?php echo$productParameters['id']; ?>">
            </div>
            <div class="wrapper">
                <div class="picture">
                    <div class="input-file-wrapper"
                    <?php if ( strlen($productParameters['image']) > 0 ):?>
                        style="background-image: url(/template/images/product/<?php echo $productParameters['image']; ?>);"
                        <?php endif ?> >
                        <input id="file" class="input-file" type="file" name="file" accept="image/jpeg" onchange="previewPhoto(this, '.new-product .picture')" />
                        <input type="text" name="action" disabled="disabled" style="display: none;" value="save avatar" >
                        <label for="file" <?php echo (strlen( $productParameters['image'] ) > 0 ? 'class="hide-label"' : '');?>>
                            <i class="far fa-image"></i>
                        </label>
                    </div>
                </div>
                <div class="input-fields">
                    <div>
                        <p>Назва</p>
                        <input type="text" name="name" autocomplete="off" required value="<?php echo $productParameters['name']; ?>">
                    </div>
                    <div class="category">
                        <p>Категорія</p>
                        <select name="category">
                            <?php foreach ($categories as $categoryItem):?>
                                <option value="<?php echo $categoryItem['id']; ?>" 
                                    <?php if ($productParameters['category_id'] == $categoryItem['id']) echo "selected"; ?> >
                                    <?php echo $categoryItem['name']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <p>SKU#</p>
                <input type="text" name="code" autocomplete="off" value="<?php echo $productParameters['code']; ?>">
            </div>
            <div>
                <p>Ціна</p>
                <input type="text" name="price" autocomplete="off" required value="<?php echo $productParameters['price']; ?>">
            </div>
            <div>
                <p>Опис</p>
                <textarea name="description"><?php echo $productParameters['description']; ?></textarea>
            </div>
            <button>Зберегти</button>
        </form>
    </div>
</div>
