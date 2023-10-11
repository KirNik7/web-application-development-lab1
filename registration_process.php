<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $birthdate = $_POST['birthdate'];

    $uploadDirectory = 'users_avatars/';

    if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $tmpFilePath = $_FILES['avatar']['tmp_name'];
        $newFilePath = $uploadDirectory . $_FILES['avatar']['name'];

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $avatar_path = $newFilePath;
        } else {
            die("Ошибка при загрузке аватара.");
        }
    } else {
        die("Ошибка при загрузке файла.");
    }

    $userData = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'middle_name' => $middle_name,
        'email' => $email,
        'password' => $password,
        'birthdate' => $birthdate,
        'avatar_path' => $avatar_path,
    ];

    $userDataJson = json_encode($userData);

    file_put_contents('users.txt', $userDataJson);

    echo "Регистрация успешна. <a href='profile.php'>Перейти в личный кабинет</a>";
} else {
    echo "Неверный метод запроса.";
}
?>
