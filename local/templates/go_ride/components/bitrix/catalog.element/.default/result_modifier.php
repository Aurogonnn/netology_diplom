<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Обработка характеристик товара

$arrProps = ['SIZE', 'COLOR'];

function variablesProp($prop_code, &$arResult)
{
    $propertyEnums = [];

    $arFilter = [
        "IBLOCK_ID" => 4,
        "CODE" => $prop_code,

    ];

    $res = CIBlockPropertyEnum::GetList(
        Array("SORT"=>"ASC", "VALUE"=>"ASC"),
        $arFilter
    );

    while($enumFields = $res->Fetch())
    {
        $propertyEnums[$enumFields['ID']] = $enumFields['VALUE'];
    }

    $arResult["PROPERTIES"][$prop_code]['VARIABLES'] = $propertyEnums;
}

foreach ($arrProps as $prop) {
    variablesProp($prop,$arResult);
}

// Обработка доп. изображений товара

$files_id = $arResult['PROPERTIES']['IMAGES']['VALUE']; // ID файлов
$files_path = [];

foreach ($files_id as $file_id) {
    $file_path = CFile::GetPath($file_id);
    $files_path[] = $file_path;
    $arResult['PROPERTIES']['IMAGES']['SRC'] = $files_path;
}
