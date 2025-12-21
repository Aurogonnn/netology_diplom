<?php
require $_SERVER['DOCUMENT_ROOT'] . '/local/kint.phar';

/** @global CMain $APPLICATION */
/** @global CUser $USER */
$lang = LANGUAGE_ID;
$charset = SITE_CHARSET;

use Bitrix\Main\Page\Asset;

\Bitrix\Main\UI\Extension::load("jquery2");

$APPLICATION->SetTitle("Магазин спортивных товаров");

$asset = Asset::getInstance();

$asset->addCss(SITE_TEMPLATE_PATH . "/css/slick.css");
$asset->addCss(SITE_TEMPLATE_PATH . "/css/style.css");

$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/slick.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/scripts.js");

?>

<!doctype html>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <?$APPLICATION->ShowHead()?>
</head>

<body>
<?$APPLICATION->ShowPanel()?>
<?//d($APPLICATION->getCurPage())?>

    <header class="header header--catalog">
        <div class="container">
            <div class="header__wrp">
                <div class="header__wrp-nav header__wrp-nav--catalog" style="width: 100%; max-width: 1920px;">
                    <?
                    // Логотип
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/logo.php"
                        )
                    );?>
                    <?
                    // Меню
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "menu_top",
                        Array(
                        )
                    );?>
                    <div class="header__nav-box header__search">
                        <?
                        // Форма поиска
                        $APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            "go_search",
                            Array(
                            )
                        );?>
                        <?
                        // Личный кабинет
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/lk.php"
                            )
                        );?>

                        <?
                        // Корзина
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/basket.php"
                            )
                        );?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__catalog-nav container">
            <a href="<?=SITE_DIR?>catalog/">каталог</a>
            <nav class="header__catalog-categories" style="margin-bottom: 50px;">
                <ul>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"go_ride_nav_menu", 
	array(
		"ROOT_MENU_TYPE" => "catalog",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "catalog",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "go_ride_nav_menu"
	),
	false
);?>
                </ul>
            </nav>

                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "go_ride_nav_menu_left",
                    [
                        "ROOT_MENU_TYPE" => "catalog_nav",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "Y",
                        "ALLOW_MULTI_SELECT" => "N"
                    ],
                    false
                );?>
        </div>


        <?
        // Баннер со скидкой 5%
        if($APPLICATION->getCurPage() == '/catalog/') {
            $APPLICATION->IncludeComponent("bitrix:catalog.section", "go_ride_sale_catalog", Array(
                "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
                "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                "BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
                "BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
                "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
                "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                "CACHE_TYPE" => "N",	// Тип кеширования
                "COMPATIBLE_MODE" => "N",	// Включить режим совместимости
                "COMPONENT_TEMPLATE" => "go_ride_sale",
                "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":25}}]}",	// Фильтр товаров
                "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
                "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                "DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
                "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                "ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
                "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
                "ENLARGE_PRODUCT" => "STRICT",	// Выделять товары в списке
                "FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
                "HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
                "IBLOCK_ID" => "4",	// Инфоблок
                "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                "LABEL_PROP" => array(	// Свойства меток товара
                    0 => "POPULAR",
                ),
                "LABEL_PROP_MOBILE" => array(	// Свойства меток товара, отображаемые на мобильных устройствах
                    0 => "POPULAR",
                ),
                "LABEL_PROP_POSITION" => "top-left",	// Расположение меток товара
                "LAZY_LOAD" => "N",	// Показать кнопку ленивой загрузки Lazy Load
                "LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
                "LOAD_ON_SCROLL" => "N",	// Подгружать товары при прокрутке до конца
                "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
                "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
                "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
                "MESS_BTN_LAZY_LOAD" => "Показать ещё",	// Текст кнопки "Показать ещё"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
                "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",	// Сообщение о недоступности услуги
                "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
                "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
                "OFFERS_LIMIT" => "5",
                "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                "PAGER_TITLE" => "Товары",	// Название категорий
                "PAGE_ELEMENT_COUNT" => "18",	// Количество элементов на странице
                "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRICE_CODE" => "",	// Тип цены
                "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",	// Порядок отображения блоков товара
                "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",	// Вариант отображения товаров
                "PRODUCT_SUBSCRIPTION" => "Y",	// Разрешить оповещения для отсутствующих товаров
                "SECTION_CODE" => "",	// Код раздела
                "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
                "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                "SECTION_USER_FIELDS" => array(	// Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "SEF_MODE" => "N",	// Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                "SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
                "SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
                "SET_STATUS_404" => "N",	// Устанавливать статус 404
                "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
                "SHOW_404" => "N",	// Показ специальной страницы
                "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
                "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
                "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
                "SHOW_MAX_QUANTITY" => "N",	// Показывать остаток товара
                "SHOW_OLD_PRICE" => "N",	// Показывать старую цену
                "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                "SHOW_SLIDER" => "Y",	// Показывать слайдер для товаров
                "SLIDER_INTERVAL" => "3000",	// Интервал смены слайдов, мс
                "SLIDER_PROGRESS" => "N",	// Показывать полосу прогресса
                "TEMPLATE_THEME" => "blue",	// Цветовая тема
                "USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
                "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
                "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
                "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
            ),
                false
            );
        }
        ?>
    </header>

