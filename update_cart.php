<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cartData"])) {
    $cartData = json_decode($_POST["cartData"], true);

    // Загрузить данные из cart.txt
    $cartFile = 'cart.txt'; // Путь к файлу корзины
    $currentCartData = loadCartData($cartFile);

    foreach ($cartData as $updatedItem) {
        $productId = $updatedItem["id"];
        $newQuantity = $updatedItem["newQuantity"];

        foreach ($currentCartData as &$cartItem) {
            if ($cartItem["id"] == $productId) {
                $cartItem["quantity"] = $newQuantity;
                break; // Прерываем внутренний цикл, чтобы не обновлять более одного товара
            }
        }
    }

    // Обновим данные в cart.txt
    saveCartData($currentCartData, $cartFile);

    // Ответ на успешное обновление
    echo "success";
} else {
    // Обработка ошибки или неверного запроса
    echo "Ошибка запроса";
}

function loadCartData($cartFile) {
    return json_decode(file_get_contents($cartFile), true);
}

function saveCartData($cartData, $cartFile) {
    file_put_contents($cartFile, json_encode($cartData));
}
?>
