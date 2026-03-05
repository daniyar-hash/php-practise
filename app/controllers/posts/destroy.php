<?php

$db = \myframew\App::get(\myframew\Db::class);


$api_data = json_decode(file_get_contents('php://input'),true);

$data = $api_data ?? $_POST;


$id = $data['id'] ?? 0;

$db->query('delete from posts where id = ?' , [$id]);

if($db->rowCount()){

    $res['answer'] = $_SESSION['success'] = 'Post deleted';
    
}
else {
    $res['answers'] = $_SESSION['error'] = 'Deletion error';
}

if($api_data){

    echo json_encode($res);
    die;
}

redirect('/');

