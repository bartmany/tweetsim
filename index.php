<?php
require_once('./autoloader.php');

session_start();

$user = null;

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $user = user::loadById($_SESSION['id']);
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
    if (isset($user)){
        echo 'Logged as '.$user->getUsername();
        $tweets = tweet::loadAll();
        foreach ($tweets as $tweet){
            $user = user::loadById($tweet->getUserId());
            $comments = comment::loadAllCommentsByPostId($tweet->getId());
            echo "</br></br>tweettext</br>".$tweet->getText()."</br></br>tweetdate</br>".$tweet->getCreationDate()."</br>></br>tweetuserid</br>".$user->getUsername();
            foreach ($comments as $comment){
                $user = user::loadById($comment->getUserId());
                echo "</br>tweetcomment</br>".$comment->getText()."</br>".$comment->getCreationDate()."</br>".$user->getUsername();
                echo "<form action='' method='post' role='form'><label>Add comment</label><input type='text'><input type='submit'></form>";
            }
        }
    }
    ?>
  </body>
</html>
