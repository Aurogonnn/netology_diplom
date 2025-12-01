<?php
// Отключаем вывод ошибок в браузер
ini_set('display_errors', 0);
error_reporting(0);

// Устанавливаем заголовки ДО любого вывода
header('Content-Type: application/json; charset=utf-8');

// Полный путь к прологу Битрикс
$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../..');
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);
define('BX_WITH_ON_AFTER_EPILOG', true);

// Подключаем Битрикс
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// Проверяем, что Битрикс загрузился
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Bitrix not loaded'
    ]);
    exit();
}

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

// Получаем данные
$rawInput = file_get_contents('php://input');
$postData = [];

// Пробуем получить JSON
if (!empty($rawInput)) {
    $postData = json_decode($rawInput, true);
}

// Если не JSON, используем обычный POST
if (empty($postData)) {
    $postData = $_POST;
}

// Логируем для отладки
$logFile = $_SERVER['DOCUMENT_ROOT'].'/ajax_log.txt';
file_put_contents($logFile, date('Y-m-d H:i:s')." - Input: ".print_r($postData, true)."\n", FILE_APPEND);

// Получаем данные
$productId = isset($postData['product_id']) ? (int)$postData['product_id'] : 0;
$quantity = isset($postData['quantity']) ? (int)$postData['quantity'] : 1;

// Получаем свойства
$properties = [];
if (isset($postData['properties'])) {
    if (is_string($postData['properties'])) {
        $properties = json_decode($postData['properties'], true) ?: [];
    } elseif (is_array($postData['properties'])) {
        $properties = $postData['properties'];
    }
}

// Проверяем sessid (опционально, можно закомментировать для теста)
if (!check_bitrix_sessid()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Session error. Please refresh page.',
        'debug' => [
            'sessid_received' => $postData['sessid'] ?? 'none',
            'sessid_expected' => bitrix_sessid()
        ]
    ]);
    exit();
}

// Валидация
if ($productId <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid product ID'
    ]);
    exit();
}

if ($quantity <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid quantity'
    ]);
    exit();
}

try {
    // Получаем корзину
    $fuserId = \Bitrix\Sale\Fuser::getId();
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fuserId, SITE_ID);

    // Подготавливаем данные товара
    $itemFields = [
        'PRODUCT_ID' => $productId,
        'QUANTITY' => $quantity,
        'MODULE' => 'catalog',
        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        'CAN_BUY' => 'Y',
        'DELAY' => 'N',
        'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency()
    ];

    // Добавляем свойства
    if (!empty($properties)) {
        $itemFields['PROPS'] = [];
        foreach ($properties as $code => $value) {
            if (!empty($value)) {
                $itemFields['PROPS'][] = [
                    'NAME' => $code,
                    'CODE' => $code,
                    'VALUE' => $value
                ];
            }
        }
    }

    // Добавляем товар в корзину
    $addResult = \Bitrix\Catalog\Product\Basket::addProductToBasket($basket, $itemFields, ['SITE_ID' => SITE_ID]);

    if ($addResult->isSuccess()) {
        // Сохраняем корзину
        $saveResult = $basket->save();

        if ($saveResult->isSuccess()) {
            // Получаем обновленную корзину
            $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fuserId, SITE_ID);
            $basketItems = $basket->getBasketItems();

            $itemsCount = 0;
            $totalPrice = 0;

            foreach ($basketItems as $item) {
                $itemsCount += $item->getQuantity();
                $totalPrice += $item->getFinalPrice();
            }

            // Форматируем цену
            $formattedPrice = number_format($totalPrice, 0, '', ' ') . ' руб.';

            echo json_encode([
                'status' => 'success',
                'message' => 'Product added to cart',
                'data' => [
                    'items_count' => $itemsCount,
                    'total_price' => $totalPrice,
                    'formatted_price' => $formattedPrice,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]
            ]);

            file_put_contents($logFile, date('Y-m-d H:i:s')." - Success: Product {$productId} added\n", FILE_APPEND);

        } else {
            $errors = $saveResult->getErrorMessages();
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to save cart: ' . implode(', ', $errors)
            ]);
            file_put_contents($logFile, date('Y-m-d H:i:s')." - Save error: ".implode(', ', $errors)."\n", FILE_APPEND);
        }

    } else {
        $errors = $addResult->getErrorMessages();
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to add product: ' . implode(', ', $errors)
        ]);
        file_put_contents($logFile, date('Y-m-d H:i:s')." - Add error: ".implode(', ', $errors)."\n", FILE_APPEND);
    }

} catch (\Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Server error: ' . $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
    file_put_contents($logFile, date('Y-m-d H:i:s')." - Exception: ".$e->getMessage()."\n", FILE_APPEND);
}

// Завершаем без эпилога, чтобы не было лишнего HTML
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>