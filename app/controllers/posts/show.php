<?php 











$db = \myframew\App::get(\myframew\Db::class);

$slug = getParam('slug');

// dump(getParam('slug'));

// $id = $_GET['id'] ?? 0;

// die;

$post =  $db->query("SELECT * from posts where slug = ? LIMIT 1", [$slug])->findOrFail();


$title = "Page: {$post['title']}";

require_once VIEWS . '/posts/show.tpl.php';



