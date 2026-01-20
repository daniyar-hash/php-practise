<?php

$container = new \myframew\ServiceContainer();

$container->setService(\myframew\Db::class, function(){
    
  $db_config =  require CONFIG . '/db.php';
  return (\myframew\Db::getInstance())->getConnection($db_config);
});


\myframew\App::setContainer($container);