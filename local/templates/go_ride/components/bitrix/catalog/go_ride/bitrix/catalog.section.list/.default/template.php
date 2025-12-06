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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$arSectionsByParent = array();
foreach($arResult['SECTIONS'] as $arSection) {
    $parentId = $arSection['IBLOCK_SECTION_ID'] ?: 0;
    $arSectionsByParent[$parentId][] = $arSection;
}

//d($arResult);
?>

<main>
<?php
if(isset($arSectionsByParent[0]) && count($arSectionsByParent[0]) > 0):
    foreach($arSectionsByParent[0] as $arSection):
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

        $childSections = isset($arSectionsByParent[$arSection['ID']]) ? $arSectionsByParent[$arSection['ID']] : array();
        ?>
        <?php if ($arSection['THIRD_ITEM'] == 'Y'): ?>
        <?
        // Раздел "Просмотренные"

        $APPLICATION->IncludeComponent(
        "bitrix:catalog.products.viewed",
        "go_ride_viewed_catalog",
        array(
        "ACTION_VARIABLE" => "action_cpv",
        "ADDITIONAL_PICT_PROP_2" => "-",
        "ADDITIONAL_PICT_PROP_3" => "-",
        "ADDITIONAL_PICT_PROP_4" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "N",
        "CONVERT_CURRENCY" => "N",
        "DEPTH" => "2",
        "DISPLAY_COMPARE" => "N",
        "ENLARGE_PRODUCT" => "STRICT",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "4",
        "IBLOCK_MODE" => "single",
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP_2" => "",
        "LABEL_PROP_4" => "",
        "LABEL_PROP_POSITION" => "top-left",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "PAGE_ELEMENT_COUNT" => "9",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
        0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "SECTION_CODE" => "",
        "SECTION_ELEMENT_CODE" => "",
        "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
        "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "COMPONENT_TEMPLATE" => "go_ride_viewed"
        ),
        false
        );
        ?>
        <?php endif;?>

        <?php if ($arSection['LAST_ITEM'] == 'Y'): ?>
        <?
        // Раздел "Распродажа"

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "go_ride_sale_catalog_bottom",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "-",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "-",
                "BASKET_URL" => "/personal/basket.php",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "COMPATIBLE_MODE" => "N",
                "COMPONENT_TEMPLATE" => "go_ride_sale_catalog_bottom",
                "CONVERT_CURRENCY" => "N",
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":25}}]}",
                "DETAIL_URL" => "",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "arrFilter",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "4",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => array(
                    0 => "POPULAR",
                ),
                "LABEL_PROP_MOBILE" => array(
                    0 => "POPULAR",
                ),
                "LABEL_PROP_POSITION" => "top-left",
                "LAZY_LOAD" => "N",
                "LINE_ELEMENT_COUNT" => "3",
                "LOAD_ON_SCROLL" => "N",
                "MESSAGE_404" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "OFFERS_LIMIT" => "5",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "18",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "SECTION_CODE" => "",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SHOW_ALL_WO_SECTION" => "Y",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            ),
            false
        );?>
        <?php endif;?>
    <section class="products">
        <div class="container">
                    <h2 id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                        <a style="color: white; cursor: pointer;" href="<?=$arSection['SECTION_PAGE_URL'];?>">
                            <?=($arSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] ?: $arSection["NAME"]);?>
                        </a>
                    </h2>

                    <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "go_ride_catalog_slider",
                    array(
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => $arSection['ID'],
                        "SECTION_CODE" => $arSection['CODE'],
                        "SECTION_USER_FIELDS" => array(),
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "FILTER_NAME" => "arrFilter",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "PAGE_ELEMENT_COUNT" => "20",
                        "LINE_ELEMENT_COUNT" => "3",
                        "PROPERTY_CODE" => array(0 => "", 1 => ""),
                        "SET_META_KEYWORDS" => "Y",
                        "META_KEYWORDS" => "-",
                        "SET_META_DESCRIPTION" => "Y",
                        "META_DESCRIPTION" => "-",
                        "BROWSER_TITLE" => "-",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Товары",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                );?>
        </div>
    </section>
    <?php
    endforeach;
    ?>
<?php endif; ?>
</main>