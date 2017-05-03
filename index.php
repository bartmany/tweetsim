<?php
require_once('./autoloader.php');

//  $obj1 = new user();
//  $obj1->setUsername('Janusz z Obornik '.rand(0,9));
//  $obj1->setEmail('janusz14'.rand(0,9).'@wp.pl');
//  $obj1->setpasswordHash('1234'.rand(0,9));
//  $obj1->save();
//
// $obj2 = new tweet();
// $obj2->setUserId(1);
// $obj2->setText('dupadupadupa');
// $obj2->setCreationDate('2012-04-04');
// $obj2->save();
 //$obj1 = user::loadById(4);
 //$obj1->setUsername('Andrzej');
 //$obj1->saveToDb();
 //$obj1->delete();

//$obj3 = new comment();
//$obj3->setUserId(1);
//$obj3->setCreationDate('2002-01-01');
//$obj3->setPostId(1);
//$obj3->setText('asasdwadaweer');
//$obj3->save();

var_dump(user::loadAll());
var_dump(tweet::loadAll());
var_dump(comment::loadAll());


echo '<html>
  <head>Twitter</head>
  <body>
    <span>Logged as</span>
  </body>
</html>' ;
