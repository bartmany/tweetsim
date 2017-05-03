<?php
require_once('./autoloader.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (!$_POST['email'] && !$_POST['username'] && !$_POST['password']){
        echo "Wprowadzono nieprawidłowe dane";
    }

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new user();
    $user->setEmail($email);
    $user->setUsername($username);
    $user->setPasswordHash($password);
    $user->save();

    echo "$username prawidłowo zajerestrowany";
}
?>
<!doctype html>
<html lang="pl">
<head>
    <title>register</title>
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
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <button type="submit">register</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>