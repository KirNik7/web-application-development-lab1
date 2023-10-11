<!DOCTYPE html>
<html>
<head>
    <title>Список товаров</title>
    <style>
        .product-table {
            display: none;
        }
    </style>
</head>
<body>
<a href="index.php">Вернуться на главную</a>
    <h1>Список товаров</h1>
    <button id="tableButton">Таблица</button>
    <button id="columnButton">Столбик</button>

    <ul>
        <?php
        $productsFile = 'products.txt';
        $productsData = json_decode(file_get_contents($productsFile), true);
        ?>
    </ul>

    <table class="product-table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Описание</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($productsData) {
                foreach ($productsData as $product) {
                    echo "<tr>";
                    echo "<td><a href='product_description.php?id={$product['id']}'>" . $product['name'] . "</a></td>";
                    echo "<td>" . $product['price'] . " USD</td>";
                    echo "<td>" . $product['description'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div class="products">
        <?php
        if ($productsData) {
            foreach ($productsData as $product) {
                echo "<div class='product'>";
                echo "<h3><a href='product_description.php?id={$product['id']}'>" . $product['name'] . "</a></h3>";
                echo "<p><strong>Цена: </strong>" . $product['price'] . " USD</p>";
                echo "<p><strong>Описание: </strong>" . $product['description'] . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <script>
        const tableButton = document.getElementById('tableButton');
        const columnButton = document.getElementById('columnButton');
        const table = document.querySelector('.product-table');
        const column = document.querySelector('.products');

        tableButton.addEventListener('click', () => {
            table.style.display = 'table';
            column.style.display = 'none';
        });

        columnButton.addEventListener('click', () => {
            table.style.display = 'none';
            column.style.display = 'block';
        });
    </script>
</body>
</html>
