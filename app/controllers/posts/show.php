<?php 

$db = \myframew\App::get(\myframew\Db::class);

$id = $_GET['id'] ?? 0;

$post =  $db->query("SELECT * from posts where id = ? LIMIT 1", [$id])->findOrFail();


$title = "Page: {$post['title']}";

require_once VIEWS . '/posts/show.tpl.php';



