<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

switch ($arResult['CAN_BUY']){
    case true:
        $available = 'В наличии';
        break;
    case false:
        $available = 'Нет в наличии';
        break;
}

$color_item = $arResult['PROPERTIES']['COLOR']['VALUE'];
$size_item = $arResult['PROPERTIES']['SIZE']['VALUE'];
$color_item_variant = $arResult['PROPERTIES']['COLOR']['VARIABLES'];
$size_item_variant = $arResult['PROPERTIES']['SIZE']['VARIABLES'];
$item_additional_images = $arResult['PROPERTIES']['IMAGES']['SRC'];
$productId = $arResult['ID'];
$labels = $arResult['LABEL_ARRAY_VALUE'];
//d($arResult);

?>


<section class="product-card">
    <div class="container">
        <h1><?=$arResult['NAME']?></h1>
        <div class="product-card__info-wrp">
            <div class="product-card__img-wrp">
                <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="bike">
            </div>

            <form class="product-card__form" data-product-id="<?=$productId?>">
                <div class="product-card__form-wrp">
                    <fieldset>
                        <div class="product-card__form-title-wrp">
                            <legend style="color: #FFFEFE;">Размер</legend>
                            <button type="button">Size guide</button>
                        </div>
                        <div class="product-card__form-radio-wrp">
                            <? foreach ($size_item_variant as $key => $value): ?>
                                <input
                                        class="visually-hidden"
                                        type="radio"
                                        id="<?=$value?>-size"
                                        name="size"
                                        value="<?=$value?>-size"
                                    <?=($value === $size_item) ? 'checked' : '' ;?>
                                >
                                <label for="<?=$value?>-size">
                                    <?=$value?>
                                </label>
                            <? endforeach;?>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="product-card__form-title-wrp">
                            <legend style="color: #FFFEFE;">Цвет</legend>
                        </div>
                        <div class="product-card__form-radio-wrp product-card__form-radio-wrp--size">
                            <? foreach ($color_item_variant as $key => $value): ?>
                                <input
                                        class="visually-hidden"
                                        type="radio"
                                        id="<?=$value?>"
                                        name="color"
                                        value="<?=$value?>"
                                    <?=($value === $color_item) ? 'checked' : '' ;?>
                                >
                                <label for="<?=$value?>">
                                    <?=$value?>
                                </label>
                            <? endforeach;?>
                        </div>
                    </fieldset>
                    <h3>Наличие</h3>
                    <span><?=$available?></span>
                    <p><?=$arResult['ITEM_PRICES'][0]['UNROUND_PRICE']?> р.</p>
                </div>
                <button type="button" class="add-to-cart-btn btn-buy">Добавить в корзину</button>
            </form>
        </div>
    </div>
</section>

<section class="information">
    <h2 class="visually-hidden">information</h2>
    <div class="container">
        <div class="information__wrp">
            <div class="information__images">
                <? foreach ($item_additional_images as $img) : ?>
                <img src="<?=$img?>" alt="info">
                <? endforeach;?>
            </div>
            <div class="information__text">
                <div class="information__text-wrp">
                    <h3>Краткое описание</h3>
                    <p><?=$arResult['PROPERTIES']['SHORT_DESCRIPTION']['VALUE']?></p>
                </div>
                <div class="information__text-wrp">
                    <h3>Характеристики</h3>
                    <ul>
                        <? foreach ($labels as $label_name => $label_value) : ?>
                        <li><?=$label_name?> - <?=$label_value?></li>
                        <? endforeach;?>
                    </ul>
                </div>
                <div class="information__text-wrp">
                    <h3>Подробная информация</h3>

                    <?=$arResult['DETAIL_TEXT']?>
                </div>
            </div>
        </div>
    </div>
</section>