<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$image = $arParams['BACKGROUND_IMAGE'];
$text = $arParams['TITLE'];
//d($arParams);
?>

<section class="ride-us">
    <img alt="ride-us-pic" src=<?=$image?>>
    <a href="#"><?=$text?></a>
</section>
