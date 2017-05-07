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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p>Profile</p>
                        </div>
                        <div class="panel-body">
                            <?php
                            if (isset($user)){
                                $login = $user->getUsername();

                                echo "<p>Zalogowany jako $login </p>";
                            }
                            ?>
                        </div>
                        <div class="panel-footer">
                            <a href="logout.php" class="btn btn-danger btn-xs">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form action="tweet.php" method="post">
                                <div class="form-group">
                                    <label for="tweet">Make a tweet</label>
                                    <input type="text" class="form-control" name="tweet" placeholder="tweet text">
                                </div>
                                <button type="submit" class="btn btn-default btn-xs">Tweet!</button>
                            </form>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <?php
                                $tweets = tweet::loadAll();
                                foreach ($tweets as $tweet){
                                    $tAuthor = user::loadById($tweet->getUserId());
                                    $comments = comment::loadAllCommentsByPostId($tweet->getId());
                                        $tLogin = $tAuthor->getUsername();
                                        $tCreationDate = $tweet->getCreationDate();
                                        $tText = $tweet->getText();
                                        foreach ($comments as $comment) {
                                            $cAuthor = user::loadById($comment->getUserId());
                                            $cLogin = $cAuthor->getUsername();
                                            $cCreationDate = $comment->getCreationDate();
                                            $cText = $comment->getText();
                                        }
                                            $output = "
                                            
                                <div class=\"panel-heading\">
                                    <span class=\"pull-left\">$tLogin</span><span class=\"pull-right\">$tCreationDate</span>
                                </div>
                                <div class=\"panel-body\">
                                    <p>$tText</p>
                                </div>
                                <div class=\"panel-footer\">
                                    <div class=\"panel panel-default\">
                                        <div class=\"panel-heading\">
                                            <span class=\"pull-left\">$cLogin</span><span class=\"pull-right\">$cCreationDate</span>
                                        </div>
                                        <div class=\"panel-body\">
                                            <p>$cText</p>
                                        </div>
                                        <div class=\"panel-footer\">
                                            <form action=\"comment.php\" method=\"post\">
                                                <div class=\"form-group\">
                                                    <input type=\"text\" class=\"form-control\" name=\"comment\" placeholder=\"comment text\">
                                                </div>
                                                <button type=\"submit\" class=\"btn btn-default btn-xs\">comment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                            
                                            ";
                                            echo $output;

                                }
                                ?>
<!--                                <div class="panel-heading">-->
<!--                                    <span class="pull-left">tweet author</span><span class="pull-right">data</span>-->
<!--                                </div>-->
<!--                                <div class="panel-body">-->
<!--                                    <p>tweet</p>-->
<!--                                </div>-->
<!--                                <div class="panel-footer">-->
<!--                                    <div class="panel panel-default">-->
<!--                                        <div class="panel-heading">-->
<!--                                            <span class="pull-left">comment author</span><span class="pull-right">data</span>-->
<!--                                        </div>-->
<!--                                        <div class="panel-body">-->
<!--                                            <p>comment text</p>-->
<!--                                        </div>-->
<!--                                        <div class="panel-footer">-->
<!--                                            <form action="comment.php" method="post">-->
<!--                                                <div class="form-group">-->
<!--                                                    <input type="text" class="form-control" name="comment" placeholder="comment text">-->
<!--                                                </div>-->
<!--                                                <button type="submit" class="btn btn-default btn-xs">comment</button>-->
<!--                                            </form>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>