<div class="new-product-wrapper">
    <div class="new-product">
        <h2>Новий товар 
            <span title="Закрити" onclick="$('.new-product-wrapper').removeClass('active');">Х</span>
        </h2>
        <form id="new-product" action="/new-product" method="post" enctype="multipart/form-data">
            <div class="wrapper">
                <div class="picture">
                    <div class="input-file-wrapper">
                        <input id="file" class="input-file" type="file" name="file" accept="image/jpeg" onchange="previewPhoto(this, '.new-product .picture')" />
                        <input type="text" name="action" disabled="disabled" style="display: none;" value="save avatar" >
                        <label for="file">
                            <i class="far fa-image"></i>
                        </label>
                    </div>
                </div>
                <div class="input-fields">
                    <div>
                        <p>Назва</p>
                        <input type="text" name="name" autocomplete="off" required>
                    </div>
                    <div class="category">
                        <p>Категорія</p>
                        <select name="category">
                            <?php foreach ($categories as $categoryItem):?>
                                <option value="<?php echo $categoryItem['id']; ?>"><?php echo $categoryItem['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <p>SKU#</p>
                <input type="text" name="code" autocomplete="off">
            </div>
            <div>
                <p>Ціна</p>
                <input type="text" name="price" autocomplete="off" required>
            </div>
            <div>
                <p>Опис</p>
                <textarea name="description"></textarea>
            </div>
            <button>Зберегти</button>
        </form>
    </div>
</div>