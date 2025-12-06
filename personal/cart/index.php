<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "go_ride_basket", Array(
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
			5 => "PROPS",
			6 => "DELETE",
			7 => "DELAY",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",	// Страница оформления заказа
		"HIDE_COUPON" => "Y",	// Спрятать поле ввода купона
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"PRICE_VAT_SHOW_VALUE" => "Y",	// Отображать значение НДС
		"TEMPLATE_THEME" => "site",	// Цветовая тема
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
		),
		"COMPONENT_TEMPLATE" => "bootstrap_v4",
		"DEFERRED_REFRESH" => "N",	// Использовать механизм отложенной актуализации данных товаров с провайдером
		"USE_DYNAMIC_SCROLL" => "Y",	// Использовать динамическую подгрузку товаров
		"SHOW_FILTER" => "Y",	// Отображать фильтр товаров
		"SHOW_RESTORE" => "Y",	// Разрешить восстановление удалённых товаров
		"COLUMNS_LIST_EXT" => array(	// Выводимые колонки
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "TYPE",
			6 => "SUM",
		),
		"COLUMNS_LIST_MOBILE" => array(	// Колонки, отображаемые на мобильных устройствах
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
		),
		"TOTAL_BLOCK_DISPLAY" => array(	// Отображение блока с общей информацией по корзине
			0 => "top",
		),
		"DISPLAY_MODE" => "extended",	// Режим отображения корзины
		"PRICE_DISPLAY_MODE" => "Y",	// Отображать цену в отдельной колонке
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки рядом с изображением
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",	// Расположение процента скидки
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",	// Порядок отображения блоков товара
		"USE_PRICE_ANIMATION" => "Y",	// Использовать анимацию цен
		"LABEL_PROP" => array(	// Свойства меток товара
			0 => "COLOR",
			1 => "SIZE",
		),
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"CORRECT_RATIO" => "Y",	// Автоматически рассчитывать количество товара кратное коэффициенту
		"AUTO_CALCULATION" => "Y",	// Автопересчет корзины
		"ACTION_VARIABLE" => "basketAction",	// Название переменной действия
		"COMPATIBLE_MODE" => "Y",	// Включить режим совместимости
		"EMPTY_BASKET_HINT_PATH" => "/",	// Путь к странице для продолжения покупок
		"ADDITIONAL_PICT_PROP_2" => "-",	// Дополнительная картинка [Одежда]
		"ADDITIONAL_PICT_PROP_3" => "-",	// Дополнительная картинка [Одежда (предложения)]
		"ADDITIONAL_PICT_PROP_4" => "-",	// Дополнительная картинка [Товары для спорта]
		"BASKET_IMAGES_SCALING" => "adaptive",	// Режим отображения изображений товаров
		"USE_GIFTS" => "N",	// Показывать блок "Подарки"
		"USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
		"LABEL_PROP_MOBILE" => array(	// Свойства меток товара, отображаемые на мобильных устройствах
			0 => "COLOR",
			1 => "SIZE",
		),
		"LABEL_PROP_POSITION" => "top-left",	// Расположение меток товара
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>