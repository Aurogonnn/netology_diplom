<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php
use \Local\Common\Cart;
use Bitrix\Main\Application;

$arResult = array(
    'hasError' => true,
    'msg' => "Ошибка отправки",
);

$request = Application::getInstance()->getContext()->getRequest();

if (!$request->isPost()) {
    echo json_encode($arResult);
    die();
}

$cnt = intval(htmlspecialcharsEx($request->getPost('cnt')));
$prodId = intval(htmlspecialcharsEx($request->getPost('prod-id')));

if ($cnt <= 0 && $prodId <= 0) {
    $arResult['msg'] = "Ошибка отправки 2";
    echo json_encode($arResult);
    die();
}

$item = Cart::add($prodId, $cnt);

if(!$item) {
    $arResult['msg'] = "Ошибка отправки 3";
    echo json_encode($arResult);
    die();
}

$arResult = array(
    'hasError' => false,
    'msg' => "Товар добавлен в корзину",
);

echo json_encode($arResult);
die();

?>