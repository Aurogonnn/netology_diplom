<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Iblock;
CModule::IncludeModule("iblock");

$APPLICATION->SetTitle("Все отзывы");

$productId = $_REQUEST["product_id"];

function getReviewed($productId)
{
    $IBLOCK_ID = 6;
    $PROPERTY_CODE = "PRODUCT";
    $PROPERTY_VALUE = $productId;

    $result = [];

    $arFilter = Array(
        "IBLOCK_ID" => $IBLOCK_ID,
        "ACTIVE" => "Y",
        "PROPERTY_" . $PROPERTY_CODE => $PROPERTY_VALUE,
    );

    $arSelect = Array("ID", "NAME", "USER_NAME", "PROPERTY_REVIEW", "CREATED_DATE");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);

    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $result["PROPERTIES"]["REVIEWED"][] = [
            "NAME" => $arFields["NAME"],
            "USER_NAME" => $arFields["USER_NAME"],
            "REVIEW" => $arFields["PROPERTY_REVIEW_VALUE"],
            "DATE" => $arFields["CREATED_DATE"],
        ];
    }

    return $result;
}

$result = getReviewed($productId);
//d($result);
?>

    <!--Блок отзывов-->
<? if(!empty($productId)) {?>
    <section class="review" style="margin-bottom: 50px;">
        <div class="container">
            <h2>Отзывы клиентов</h2>
            <div class="review__wrp">
                <ul class="review__list">
                    <? foreach ($result['PROPERTIES']['REVIEWED'] as $arReview) { ?>
                        <li class="review__item">
                            <h3><?=$arReview["NAME"]?></h3>
                            <p><?=$arReview["REVIEW"]?></p>
                            <span><?=$arReview["USER_NAME"]?></span>
                            <time><?=$arReview["DATE"]?></time>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </section>
<? } else {?>
    <section class="review" style="margin-bottom: 50px;">
        <div class="container">
            <h2>Не выбран товар</h2>
        </div>
    </section>
    <?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>