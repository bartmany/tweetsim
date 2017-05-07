<?php
require_once('./autoloader.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['tweet'])){
//        var_dump($_POST['tweet']);
//        var_dump($_SESSION);
        $date = new DateTime();
        $tweet = new tweet();
        $tweet->setUserId($_SESSION['id']);
        $tweet->setCreationDate($date->format('Y-m-d'));
        $tweet->setText($_POST['tweet']);
        $tweet->save();
    }
}