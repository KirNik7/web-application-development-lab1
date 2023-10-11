<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="index.php">Вернуться на главную</a>
    <h1>Личный кабинет</h1>
    <div class="tabs">
        <div class="tab" id="personalDataTab">Личные данные</div>
        <div class="tab" id="orderHistoryTab">История заказов</div>
    </div>
    <div class="content" id="personalDataContent">
    <?php
$userDataFile = 'users.txt';

if (file_exists($userDataFile)) {
    $userData = json_decode(file_get_contents($userDataFile), true);

    if ($userData !== null) {

        echo "<h2>Личные данные</h2>";
        echo "Фамилия: " . $userData['last_name'] . "<br>";
        echo "Имя: " . $userData['first_name'] . "<br>";
        echo "Отчество: " . $userData['middle_name'] . "<br>";
        echo "Почта: " . $userData['email'] . "<br>";
        echo "Дата рождения: " . $userData['birthdate'] . "<br>";
        echo "<img src='" . $userData['avatar_path'] . "' alt='Аватар пользователя'>";
    } else {
        echo "Данные о пользователе в файле не найдены или файл пуст.";
    }
} else {
    echo "Файл с данными о пользователе не найден.";
}
?>

    </div>
    <div class="content" id="orderHistoryContent">
    <h2>Нет заказов</h2>
    </div>
    <script src="script.js"></script>
</body>
</html>
