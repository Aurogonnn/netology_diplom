<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

// Получаем данные товара
$color_item = $arResult['PROPERTIES']['COLOR']['VALUE'] ?? '';
$size_item = $arResult['PROPERTIES']['SIZE']['VALUE'] ?? '';
$color_item_variant = $arResult['PROPERTIES']['COLOR']['VARIABLES'] ?? [];
$size_item_variant = $arResult['PROPERTIES']['SIZE']['VARIABLES'] ?? [];
$item_additional_images = $arResult['PROPERTIES']['IMAGES']['SRC'] ?? [];
$productId = $arResult['ID'];
$labels = $arResult['LABEL_ARRAY_VALUE'] ?? [];

// Статус наличия
$available = $arResult['CAN_BUY'] ? 'В наличии' : 'Нет в наличии';
$price = $arResult['ITEM_PRICES'][0]['UNROUND_PRICE'] ?? 0;

// Создаем уникальный идентификатор для формы
$formId = 'product_form_' . $productId . '_' . rand(1000, 9999);

// Обработка добавления в корзину
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $postedProductId = (int)$_POST['product_id'];

    // Проверяем, что ID совпадает с текущим товаром
    if ($postedProductId === $productId && check_bitrix_sessid()) {
        \Bitrix\Main\Loader::includeModule('sale');
        \Bitrix\Main\Loader::includeModule('catalog');

        $quantity = (int)$_POST['quantity'] ?: 1;
        $properties = [];

        // Получаем свойства из POST
        if (isset($_POST['size']) && !empty($_POST['size'])) {
            $properties[] = [
                'NAME' => 'Размер',
                'CODE' => 'SIZE',
                'VALUE' => htmlspecialcharsbx($_POST['size'])
            ];
        }

        if (isset($_POST['color']) && !empty($_POST['color'])) {
            $properties[] = [
                'NAME' => 'Цвет',
                'CODE' => 'COLOR',
                'VALUE' => htmlspecialcharsbx($_POST['color'])
            ];
        }

        // Добавляем в корзину
        if (Add2Basket($productId, $quantity, $properties)) {
            // Сохраняем в сессии факт добавления ТОЛЬКО этого товара
            $_SESSION['LAST_ADDED_PRODUCT'] = [
                'id' => $productId,
                'time' => time(),
                'page_url' => $APPLICATION->GetCurDir()
            ];


            // Редирект без параметра, чтобы избежать повторной отправки
            LocalRedirect($APPLICATION->GetCurDir());
        }
    }
}

// Проверяем, нужно ли показывать уведомление
$showSuccessNotification = false;
if (isset($_SESSION['LAST_ADDED_PRODUCT']) &&
    $_SESSION['LAST_ADDED_PRODUCT']['id'] == $productId &&
    $_SESSION['LAST_ADDED_PRODUCT']['page_url'] == $APPLICATION->GetCurDir() &&
    (time() - $_SESSION['LAST_ADDED_PRODUCT']['time']) < 5) { // Показываем только 5 секунд

    $showSuccessNotification = true;
    // Удаляем из сессии, чтобы при обновлении не показывалось снова
    unset($_SESSION['LAST_ADDED_PRODUCT']);
}

d($arResult);
?>

<section class="product-card">
    <div class="container">
        <h1><?=htmlspecialcharsbx($arResult['NAME'])?></h1>
        <div class="product-card__info-wrp">
            <!-- Изображение товара -->
            <div class="product-card__img-wrp">
                <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=htmlspecialcharsbx($arResult['NAME'])?>">
            </div>

            <!-- Форма товара -->
            <form method="post" action="" class="product-card__form" id="<?=$formId?>">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="add_to_cart" value="1">
                <input type="hidden" name="product_id" value="<?=$productId?>">
                <input type="hidden" name="quantity" value="1">

                <div class="product-card__form-wrp">
                    <!-- Размер -->
                    <?php if (!empty($size_item_variant)): ?>
                        <fieldset>
                            <div class="product-card__form-title-wrp">
                                <legend style="color: #FFFEFE;">Размер</legend>
                                <button type="button">Size guide</button>
                            </div>
                            <div class="product-card__form-radio-wrp">
                                <?php foreach ($size_item_variant as $key => $value): ?>
                                    <?php $sizeValue = htmlspecialcharsbx($value); ?>
                                    <input
                                            class="visually-hidden"
                                            type="radio"
                                            id="size_<?=$key?>_<?=$productId?>"
                                            name="size"
                                            value="<?=$sizeValue?>"
                                        <?=($value === $size_item) ? 'checked' : '';?>
                                        <?=(!empty($size_item_variant)) ? 'required' : '';?>
                                    >
                                    <label for="size_<?=$key?>_<?=$productId?>">
                                        <?=$sizeValue?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </fieldset>
                    <?php endif; ?>

                    <!-- Цвет -->
                    <?php if (!empty($color_item_variant)): ?>
                        <fieldset>
                            <div class="product-card__form-title-wrp">
                                <legend style="color: #FFFEFE;">Цвет</legend>
                            </div>
                            <div class="product-card__form-radio-wrp product-card__form-radio-wrp--size">
                                <?php foreach ($color_item_variant as $key => $value): ?>
                                    <?php $colorValue = htmlspecialcharsbx($value); ?>
                                    <input
                                            class="visually-hidden"
                                            type="radio"
                                            id="color_<?=$key?>_<?=$productId?>"
                                            name="color"
                                            value="<?=$colorValue?>"
                                        <?=($value === $color_item) ? 'checked' : '';?>
                                        <?=(!empty($color_item_variant)) ? 'required' : '';?>
                                    >
                                    <label for="color_<?=$key?>_<?=$productId?>">
                                        <?=$colorValue?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </fieldset>
                    <?php endif; ?>

                    <!-- Наличие и цена -->
                    <h3>Наличие</h3>
                    <span class="availability-status"><?=$available?></span>

                    <!-- Цена -->
                    <div class="price-container">
                        <p class="price"><?=number_format($price, 0, '', ' ')?> р.</p>
                    </div>
                </div>

                <!-- Кнопка добавления в корзину -->
                <div class="cart-actions">
                    <?php if ($arResult['CAN_BUY']): ?>
                        <button type="submit" class="add-to-cart-btn btn-buy"
                            <?=(!empty($size_item_variant) || !empty($color_item_variant)) ? 'disabled' : ''?>
                                id="add_to_cart_btn_<?=$productId?>">
                            Добавить в корзину
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-link" disabled>
                            Нет в наличии
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Уведомление об успешном добавлении -->
<?php if ($showSuccessNotification): ?>
    <div class="success-notification" id="success_notification_<?=$productId?>">
        <div class="notification-content">
            <span class="notification-text">Товар добавлен в корзину!</span>
            <a href="/personal/cart/" class="notification-link">Перейти в корзину</a>
            <button class="notification-close">&times;</button>
        </div>
    </div>

    <style>
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            z-index: 10000;
            animation: slideIn 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            max-width: 400px;
        }

        .notification-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .notification-link {
            color: white;
            text-decoration: underline;
            font-weight: bold;
            white-space: nowrap;
        }

        .notification-link:hover {
            color: #e0e0e0;
        }

        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            margin-left: 10px;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('success_notification_<?=$productId?>');
            if (notification) {
                // Автоматически скрыть через 5 секунд
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);

                // Закрытие по клику
                notification.querySelector('.notification-close').addEventListener('click', function() {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                });
            }
        });
    </script>
<?php endif; ?>

<!-- Дополнительные изображения и описание -->
<section class="information">
    <h2 class="visually-hidden">information</h2>
    <div class="container">
        <div class="information__wrp">
            <?php if (!empty($item_additional_images)): ?>
                <div class="information__images">
                    <?php foreach ($item_additional_images as $img): ?>
                        <img src="<?=$img?>" alt="info">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="information__text">
                <!-- Краткое описание -->
                <?php if (!empty($arResult['PROPERTIES']['SHORT_DESCRIPTION']['VALUE'])): ?>
                    <div class="information__text-wrp">
                        <h3>Краткое описание</h3>
                        <p><?=htmlspecialcharsbx($arResult['PROPERTIES']['SHORT_DESCRIPTION']['VALUE'])?></p>
                    </div>
                <?php endif; ?>

                <!-- Характеристики -->
                <?php if (!empty($labels)): ?>
                    <div class="information__text-wrp">
                        <h3>Характеристики</h3>
                        <ul>
                            <?php foreach ($labels as $label_name => $label_value): ?>
                                <li><?=htmlspecialcharsbx($label_name)?> - <?=htmlspecialcharsbx($label_value)?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Подробная информация -->
                <?php if (!empty($arResult['DETAIL_TEXT'])): ?>
                    <div class="information__text-wrp">
                        <h3>Подробная информация</h3>
                        <div>
                            <?=$arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>'?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript для управления формой -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('<?=$formId?>');
        const addToCartBtn = document.getElementById('add_to_cart_btn_<?=$productId?>');

        if (!form || !addToCartBtn) return;

        // Элементы формы
        const sizeInputs = form.querySelectorAll('input[name="size"]');
        const colorInputs = form.querySelectorAll('input[name="color"]');

        // Функция проверки заполнения формы
        function checkFormValidity() {
            let isValid = true;

            // Проверяем размеры
            if (sizeInputs.length > 0) {
                const sizeSelected = Array.from(sizeInputs).some(input => input.checked);
                if (!sizeSelected) isValid = false;
            }

            // Проверяем цвета
            if (colorInputs.length > 0) {
                const colorSelected = Array.from(colorInputs).some(input => input.checked);
                if (!colorSelected) isValid = false;
            }

            // Обновляем состояние кнопки
            addToCartBtn.disabled = !isValid;

            return isValid;
        }

        // Слушаем изменения в радиокнопках
        sizeInputs.forEach(input => {
            input.addEventListener('change', checkFormValidity);
        });

        colorInputs.forEach(input => {
            input.addEventListener('change', checkFormValidity);
        });

        // Проверяем при загрузке
        checkFormValidity();

        // AJAX отправка формы (опционально)
        form.addEventListener('submit', function(e) {
            // Если товар не в наличии или кнопка disabled - отменяем
            if (addToCartBtn.disabled) {
                e.preventDefault();
                alert('Пожалуйста, выберите все необходимые параметры');
                return;
            }
        });

        // Если товар не доступен
        const availabilitySpan = form.querySelector('.availability-status');
        if (availabilitySpan && availabilitySpan.textContent.trim() === 'Нет в наличии') {
            addToCartBtn.disabled = true;
            addToCartBtn.textContent = 'Нет в наличии';
        }
    });
</script>

<!-- Стили для кнопки -->
<style>
    .add-to-cart-btn:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .cart-actions {
        margin-top: 20px;
    }

    .price {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin: 10px 0;
    }
</style>