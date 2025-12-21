<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $USER;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Iblock;

$this->setFrameMode(true);
$user_id = $USER->GetID();
$site_id = SITE_ID;

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
            <form method="post" action="" class="product-card__form" id="add_to_basket">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="user_id" value="<?=$user_id?>">
                <input type="hidden" name="site_id" value="<?=$site_id?>">
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
                        <p><?=number_format($price, 0, '', ' ')?> р.</p>
                    </div>
                </div>

                <!-- Кнопка добавления в корзину -->
                <div class="cart-actions">
                    <?php if ($arResult['CAN_BUY']): ?>
                        <button type="submit" class="add-to-cart-btn btn-buy"
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

<!--Блок отзывов-->
<? if(!empty($arResult['PROPERTIES']['REVIEWED'])) {?>
        <section class="review">
                <div class="container">
                    <h2>Отзывы клиентов</h2>
                        <div class="review__wrp">
                            <ul class="review__list">
                            <? foreach ($arResult['PROPERTIES']['REVIEWED'] as $arReview) { ?>
                                <li class="review__item">
                                    <h3><?=$arReview["NAME"]?></h3>
                                    <p><?=$arReview["REVIEW"]?></p>
                                    <span><?=$arReview["USER_NAME"]?></span>
                                    <time><?=$arReview["DATE"]?></time>
                                </li>
                            <? } ?>
                            </ul>
                            <a href="<?=SITE_DIR?>reviewed_page/index.php?product_id=<?=$productId?>"><button type="button">See all</button></a>
                        </div>
                </div>
        </section>
<? } ?>


<!-- JavaScript для управления формой -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#add_to_basket');

        if (!form) {
            console.error('Форма не найдена');
            return;
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            console.log('Форма отправляется...');

            // Собираем данные
            const formData = new FormData(this);

            // Выводим данные в консоль для отладки
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            fetch('/local/templates/go_ride/components/bitrix/catalog.element/go_ride_catalog_element/ajax/add_to_cart.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    console.log('Статус ответа:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Ответ сервера:', data);
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при отправке формы');
                });
        });
    });
</script>
