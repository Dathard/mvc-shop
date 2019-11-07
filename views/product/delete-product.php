<div class="delete-product-wrapper">
    <div class="delete-product">
        <h2>Видалення товару
            <span title="Закрити" onclick="$('.delete-product-wrapper').removeClass('active');">Х</span>
        </h2>
        <form id="delete-product" action="/delete-product" method="post" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="id" value="<?php echo$productParameters['id']; ?>">
            </div>
            <div>
                <p>Ви дійсно хочете видалити даний продукт?</p>
            </div>
            <div class="buttons">
                <span onclick="$('.delete-product-wrapper').removeClass('active');">Закрити</span>
                <button>Підтвердити</button>
            </div>
        </form>
    </div>
</div>
