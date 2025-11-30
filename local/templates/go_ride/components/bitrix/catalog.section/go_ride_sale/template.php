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
//d($arResult['ITEMS']);

if (!empty($arResult['ITEMS'])) {
    $randomKey = array_rand($arResult['ITEMS']);
    $randomItem = $arResult['ITEMS'][$randomKey];
}
//s($randomItem);
?>

<section class="sale">
    <div class="container sale__wrp">
        <h2>Скидка 5%</h2>
        <div class="sale__img-wrp">
            <img alt="helmet" src="<?=$randomItem["DETAIL_PICTURE"]["SRC"];?>">
        </div>
    </div>
</section>


