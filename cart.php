<?php
function addToCart($productId) {
    $cartData = loadCartData();
    $productExists = false;

    foreach ($cartData as &$cartItem) {
        if ($cartItem["id"] == $productId) {
            $cartItem["quantity"]++;
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $productData = getProductData($productId);
        if ($productData) {
            $productData["quantity"] = 1;
            $cartData[] = $productData;
        }
    }

    saveCartData($cartData);
    header("Location: cart.php");
}

function removeFromCart($productId) {
    $cartData = loadCartData();

    foreach ($cartData as $key => $cartItem) {
        if ($cartItem["id"] == $productId) {
            unset($cartData[$key]);
            break;
        }
    }

    saveCartData(array_values($cartData));
    header("Location: cart.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    addToCart($_POST["product_id"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    removeFromCart($_GET["id"]);
} else {
    displayCart();
}

function loadCartData() {
    return json_decode(file_get_contents("cart.txt"), true);
}

function saveCartData($cartData) {
    file_put_contents("cart.txt", json_encode($cartData));
}

function getProductData($productId) {
    $productsData = json_decode(file_get_contents("products.txt"), true);
    foreach ($productsData as $product) {
        if ($product["id"] == $productId) {
            return $product;
        }
    }
    return null;
}

function displayCart() {
    $cartData = loadCartData();
    if ($cartData) {
        echo "<!DOCTYPE html><html><head><title>Корзина</title></head><body><a href='index.php'>Вернуться на главную</a><br><a href='products.php'>Вернуться к списку товаров</a><h1>Корзина</h1><table><tr><th>Картинка товара</th><th>Название товара</th><th>Количество</th><th>Цена</th><th>Удалить</th></tr>";
        $totalPrice = 0;
        foreach ($cartData as $cartItem) {
            $totalPrice += $cartItem["price"] * $cartItem["quantity"];
            echo "<tr>";
            echo "<td><img src='{$cartItem['image']}' alt='{$cartItem['name']}' width='100' height='100'></td>";
            echo "<td>{$cartItem['name']}</td>";
            echo "<td>";
            $decrementedQuantity = $cartItem['quantity'] - 1;
            $incrementedQuantity = $cartItem['quantity'] + 1;
            echo "<button class='quantity-button' data-product-id='{$cartItem['id']}' onclick='decrementQuantity({$cartItem['id']})'>-</button>";
            echo "<span id='quantity-{$cartItem['id']}'>{$cartItem['quantity']}</span>";
            echo "<button class='quantity-button' data-product-id='{$cartItem['id']}' onclick='incrementQuantity({$cartItem['id']})'>+</button>";
            
            echo "</td>";
            echo "<td>{$cartItem['price']} USD</td>";
            echo "<td><a href='?id={$cartItem['id']}'><img src='delete_img.jpg' alt='Удалить' width='50' height='50'></a></td>";
            echo "</tr>";
        }
        echo "</table><p>Общая сумма: $totalPrice USD</p>";
        echo "<button onclick='updateCart()'>Обновить</button>";
        echo "</body></html>";
        echo "<script>
            function incrementQuantity(productId) {
                var quantityElement = document.getElementById('quantity-' + productId);
                var currentQuantity = parseInt(quantityElement.textContent);
                quantityElement.textContent = currentQuantity + 1;
            }

            function decrementQuantity(productId) {
                var quantityElement = document.getElementById('quantity-' + productId);
                var currentQuantity = parseInt(quantityElement.textContent);
                if (currentQuantity > 1) {
                    quantityElement.textContent = currentQuantity - 1;
                }
            }

            function updateCart() {
                var cartData = [];
                document.querySelectorAll('.quantity-button').forEach(function (element) {
                    var productId = element.getAttribute('data-product-id');
                    var quantityElement = document.querySelector('#quantity-' + productId);
                    var quantity = quantityElement ? parseInt(quantityElement.textContent) : 0;
                    cartData.push({ id: productId, newQuantity: quantity });
                });
            
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_cart.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            if (xhr.responseText === 'success') {
                                location.reload();
                            } else {
                                alert('Произошла ошибка при обновлении корзины.');
                            }
                        }
                    }
                };
            
                xhr.send('cartData=' + JSON.stringify(cartData));
            }
        </script>";
    } else {
        echo "<!DOCTYPE html><html><head><title>Корзина</title></head><body><a href='index.php'>Вернуться на главную</a><h1>Корзина</h1><p>Корзина пуста.</p></body></html>";
    }
}
?>
