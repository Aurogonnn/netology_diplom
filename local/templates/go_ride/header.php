<?php
require $_SERVER['DOCUMENT_ROOT'] . '/local/kint.phar';
$templateVariant = $APPLICATION->GetPageProperty("template") ?: "default";
$layoutFile = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/ваш_шаблон/layouts/{$templateVariant}.php";

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

//$currentPage = $APPLICATION->GetCurPage();
//$isMainPage = $currentPage === '/';
//
//// Детальная проверка для каталога
//$isCatalogRoot = $currentPage === '/catalog/' || $currentPage === '/catalog';
//$isCatalogSubsection = strpos($currentPage, '/catalog/') === 0 && !$isCatalogRoot;
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

<header class="header">
    <div class="container">
        <div class="header__wrp">
            <div class="header__wrp-nav">
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
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "menu_top",
                    Array(
                    )
                );?>
                <div class="header__nav-box header__search">
                    <?

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
            <div class="header__wrp-first-screen">
                <div class="header__desc">
                    <h2>go&ride</h2>
                    <p>велосипеды & аксессуары</p>
                    <a href="<?=SITE_DIR?>catalog/">магазин</a>
                </div>
            </div>
            <div class="header__second-screen">
                <picture>
                    <source srcset="<?=SITE_TEMPLATE_PATH?>/img/bycicle-mobile.png" media="(max-width: 1400px)">
                    <source srcset="<?=SITE_TEMPLATE_PATH?>/img/bicycle-first-screen.jpg">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/bicycle-first-screen.jpg" alt="bicycle"/>
                </picture>
            </div>
        </div>
    </div>
</header>


