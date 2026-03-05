<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $db = \myframew\App::get(\myframew\Db::class);




$title = 'Page:Home';

$total = db()->query("select COUNT(*) from posts")->getColumn();

$page_notes = 3;
$curr_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$pagination = new myframew\Pagination($total, $page_notes, $curr_page);

// print_arr($pagination);
// echo $pagination;



// $pages_cnt = ceil($total/$page_notes);

// if($curr_page < 1){
//     $curr_page = 1;
// }

// if($curr_page > $pages_cnt){
//     $curr_page = $pages_cnt;
// }

$start = $pagination->getStart();

$posts = db()->query("SELECT * from posts order by id DESC LIMIT $start, $page_notes")->findAll();

$recent_posts = db()->query("SELECT * from posts order by id DESC LIMIT 3")->findAll();


require_once VIEWS . '/posts/index.tpl.php';

  
  






