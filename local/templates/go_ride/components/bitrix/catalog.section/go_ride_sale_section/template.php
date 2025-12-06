<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//d($arResult);
?>
<section class="favourite favourite--section">
    <div class="favourite__slider">
        <?if (!empty($arResult['ITEMS'])):?>
            <div class="slider slick-favourite-slider">
                <?foreach ($arResult['ITEMS'] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="slider__item-wrp">
                            <?php
                            // Получаем картинку
                            $picture = null;
                            if (isset($arItem['PREVIEW_PICTURE']) && $arItem['PREVIEW_PICTURE']['SRC']) {
                                $picture = $arItem['PREVIEW_PICTURE'];
                            } elseif (isset($arItem['DETAIL_PICTURE']) && $arItem['DETAIL_PICTURE']['SRC']) {
                                $picture = $arItem['DETAIL_PICTURE'];
                            }
                            ?>
                            
                            <?if ($picture):?>
                                <img 
                                    alt="<?=$picture['ALT'] ?: $arItem['NAME'];?>" 
                                    src="<?=$picture['SRC'];?>"
                                    title="<?=$picture['TITLE'] ?: $arItem['NAME'];?>"
                                >
                            <?else:?>
                                <img alt="<?=$arItem['NAME'];?>" src="/local/templates/go_ride/img/good-1.jpg">
                            <?endif;?>
                            
                            <div class="slider__item-content-wrp">
                                <h3>
                                    <a href="<?=$arItem['DETAIL_PAGE_URL'];?>">
                                        <?=$arItem['NAME'];?>
                                    </a>
                                </h3>
                                
                                <!-- Цена -->
                                <?php 
                                $price = '';
                                if (isset($arItem['MIN_PRICE'])) {
                                    $price = $arItem['MIN_PRICE']['PRINT_VALUE'];
                                } elseif (isset($arItem['ITEM_PRICES']) && is_array($arItem['ITEM_PRICES'])) {
                                    foreach ($arItem['ITEM_PRICES'] as $priceData) {
                                        if ($priceData['PRICE'] > 0) {
                                            $price = CurrencyFormat($priceData['PRICE'], $priceData['CURRENCY']);
                                            break;
                                        }
                                    }
                                }
                                ?>
                                
                                <?if ($price):?>
                                    <p><?=$price;?></p>
                                <?else:?>
                                    <p>Цена по запросу</p>
                                <?endif;?>

                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        <?else:?>
            <p>Популярные товары не найдены</p>
        <?endif;?>
    </div>
    <div class="favourite__text">
        <div class="favourite__text-wrp">
            <h2>Распродажа</h2>
        </div>
    </div>
</section>