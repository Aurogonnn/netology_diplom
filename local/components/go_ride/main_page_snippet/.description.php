<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => "Баннер на главной странице",
    "DESCRIPTION" => "Баннер с изображением и текстом для главной страницы",
    "SORT" => 10,
    "PATH" => array(
        "ID" => "custom",
        "NAME" => "Кастомные компоненты",
        "CHILD" => array(
            "ID" => "banners",
            "NAME" => "Баннеры",
            "SORT" => 10
        )
    ),
    "COMPLEX" => "N"
);