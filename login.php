<?php
require_once('./autoloader.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $passVerify = false;
        $userToLogin = user::loadByEmail($_POST['email']);
        if (!$userToLogin){
            echo "Użytkownik nie istnieje";
        } else {
            $passVerify = password_verify($_POST['password'], $userToLogin->getPasswordHash());
            if ($passVerify == true){
                $_SESSION['email'] = $userToLogin->getEmail();
                $_SESSION['username'] = $userToLogin->getUsername();
                $_SESSION['id'] = $userToLogin->getId();
                echo "Wszystko OK";
            } else {
                echo "Wprowadzono nieprawidłowy login / hasło";
            }
        }
    } else {
        echo "Wprowadzono nieprawidłowy login / hasło";
    }
}
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header('Refresh: 0; url=index.php');
}
?>
<!doctype html>
<html lang="pl">
<head>
    <title>login</title>
</head>
<body>
<div>
    <div>
        <div>
            <form action="" method="post" role="form">
                <div>
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <button type="submit">login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>