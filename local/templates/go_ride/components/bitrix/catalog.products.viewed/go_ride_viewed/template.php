<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);

if (empty($arResult['ITEMS']) || empty($arResult['ITEM_ROWS']))
{
    return; // Если товаров нет, ничего не выводим
}

//d($arResult['ITEMS']);
?>

<section class="reviewed" data-entity="<?=$containerName?>">
    <div class="container">
        <h2>Уже просмотрели</h2>
        <?
        if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS']))
        {
            $areaIds = array();

            foreach ($arResult['ITEMS'] as $item)
            {
                $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
                $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
            }
            ?>
            <div class="slider slick-good-slider" data-entity="items-container">
                <?
                foreach ($arResult['ITEM_ROWS'] as $rowData)
                {
                    $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);

                    foreach ($rowItems as $item)
                    {
                        ?>
                        <?//d($item);?>
                        <div class="slider__item" id="<?=$areaIds[$item['ID']]?>" data-entity="item">
                            <div class="slider__item-wrp">
                                <?if ($item['PREVIEW_PICTURE']['SRC']):?>
                                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                                <?elseif ($item['DETAIL_PICTURE']['SRC']):?>
                                    <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                                <?else:?>
                                    <img src="/local/templates/.default/images/no-image.png" alt="<?=$item['NAME']?>">
                                <?endif;?>
                                <div class="slider__item-content-wrp">
                                    <h3>
                                        <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
                                    </h3>
                                        <p><?=$item["ITEM_PRICES"][0]["UNROUND_PRICE"]?> р</p>
                                </div>

                            </div>
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="btn-buy-link">
                            <button class="btn-buy">купить срочно</button>
                            </a>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <?
        }
        ?>
    </div>
</section>
