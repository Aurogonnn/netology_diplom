<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

while (ob_get_level()) ob_end_clean();

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


// Включаем модули
if (!\Bitrix\Main\Loader::includeModule('sale')) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Sale module not found'
    ]);
    exit();
}

if (!\Bitrix\Main\Loader::includeModule('catalog')) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Catalog module not found'
    ]);
    exit();
}

// Получаем данные из формы
$productId = (int)($_POST['product_id'] ?? 0);
$quantity = (int)($_POST['quantity'] ?? 1);
$user_id = (int)($_POST['user_id'] ?? 0);
$site_id = ($_POST['site_id']);


$fUserId = \CSaleBasket::GetBasketUserID(true);
$basket = \Bitrix\Sale\Basket::loadItemsForFUser($fUserId, \Bitrix\Main\Context::getCurrent()->getSite());

$product = array('PRODUCT_ID' => $productId, 'QUANTITY' => $quantity);
$result = \Bitrix\Catalog\Product\Basket::addProductToBasket($basket, $product, array('SITE_ID' => $site_id));

$save_result = $basket->save();

if ($save_result->isSuccess()) {
    echo json_encode([
        'success' => true,
        'message' => 'Товар успешно добавлен в корзину!',
        'basket_url' => '/personal/cart/',
        'product' => [
            'id' => $productId,
            'quantity' => $quantity,
            'userId' => $user_id,
        ]
    ]);
} else {
    $errorMessages = $save_result->getErrorMessages();
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка при сохранении: ' . implode(', ', $errorMessages)
    ]);
}

exit;
?>