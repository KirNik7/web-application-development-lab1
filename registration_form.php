<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
<a href="index.php">Вернуться на главную</a>
    <h1>Регистрация</h1>
    <form action="registration_process.php" method="post" enctype="multipart/form-data">
        <label>Фамилия:</label>
        <input type="text" name="last_name" required><br><br>

        <label>Имя:</label>
        <input type="text" name="first_name" required><br><br>

        <label>Отчество:</label>
        <input type="text" name="middle_name" required><br><br>

        <label>Почта:</label>
        <input type="email" name="email" required><br><br>

        <label>Пароль:</label>
        <input type="password" name="password" required><br><br>

        <label>Повторите пароль:</label>
        <input type="password" name="confirm_password" required><br><br>

        <label>Дата рождения:</label>
        <input type="date" name="birthdate" required><br><br>

        <label>Загрузите аватар:</label>
        <input type="file" name="avatar" accept="image/*"><br><br>

        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>
