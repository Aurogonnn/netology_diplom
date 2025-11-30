<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "TITLE" => array(
            "NAME" => "Заголовок блока",
            "TYPE" => "STRING",
            "DEFAULT" => "По городу",
            "PARENT" => "BASE",
        ),
        "BACKGROUND_IMAGE" => array(
            "NAME" => "Изображение для фона",
            "TYPE" => "FILE",
            "FD_TARGET" => "F",
            "FD_EXT" => "jpg,jpeg,png,gif",
            "FD_UPLOAD" => true,
            "FD_USE_MEDIALIB" => true,
            "FD_MEDIALIB_TYPES" => array('image'),
            "DEFAULT" => "",
            "PARENT" => "BASE",
        ),
        "CACHE_TIME" => array("DEFAULT" => 36000000),
    ),
);