<!DOCTYPE html>
<html>
<head>
    <title>Описание товара</title>
</head>
<body>
<a href="index.php">Вернуться на главную</a> <br>
<a href="products.php">Вернуться к списку товаров</a>
    <h1>Описание товара</h1>
    <?php
    $productId = $_GET['id'];

    $productsFile = 'products.txt';
    $productsData = json_decode(file_get_contents($productsFile), true);

    if ($productsData) {
        $selectedProduct = null;
        foreach ($productsData as $product) {
            if ($product['id'] == $productId) {
                $selectedProduct = $product;
                break;
            }
        }

        if ($selectedProduct) {
            echo "<h2>{$selectedProduct['name']}</h2>";
            echo "<img src='{$selectedProduct['image']}' alt='{$selectedProduct['name']}' width='500' height='500'>";
            echo "<p><strong>Цена: </strong>{$selectedProduct['price']} USD</p>";
            echo "<p><strong>Вес: </strong>{$selectedProduct['weight']} г</p>";
            echo "<p><strong>Количество: </strong>{$selectedProduct['quantity']} шт.</p>";
            echo "<p><strong>Описание: </strong>{$selectedProduct['description']}</p>";
        } else {
            echo "Товар не найден.";
        }
    }
    ?>
    <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <input type="submit" value="Добавить в корзину">
    </form>

</body>
</html>
