<?php
require_once('./autoloader.php');

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $loggedAs = user::loadById($_SESSION['id']);
    $username = $loggedAs->getUsername();
    $tweets = tweet::loadAll();
    var_dump($tweets);
} else {
    var_dump($_SESSION);
}
?>
<!doctype html>
<html lang="pl">
<head>
    <title>homepage</title>
</head>
  <head>

  </head>
  <body>
    <?php
    echo "<span>Logged as $username</span>
            <p></p>";
    ?>
  </body>
</html>
