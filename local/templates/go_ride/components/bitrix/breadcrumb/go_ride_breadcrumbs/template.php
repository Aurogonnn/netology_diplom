<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


if(empty($arResult))
    return "";

$strReturn = '';

$strReturn .= '<ul class="header__inner-breadcrumbs-list">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $isLast = ($index == $itemSize-1);

    if($arResult[$index]["LINK"] <> "" && !$isLast)
    {
        $strReturn .= '
			<li>
				<a href="'.$arResult[$index]["LINK"].'">
					'.htmlspecialchars($title).'
					'.(!$isLast ? '&nbsp/&nbsp' : '').'
				</a>
			</li>';
    }
    else
    {
        $strReturn .= '
			<li>
				<a href="#">
					'.htmlspecialchars($title).'
					'.(!$isLast ? '&nbsp/&nbsp' : '').'
				</a>
			</li>';
    }
}

$strReturn .= '</ul>';

return $strReturn;