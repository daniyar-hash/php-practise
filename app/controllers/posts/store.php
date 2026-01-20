<?php 


use myframew\Validator;

$db = \myframew\App::get(\myframew\Db::class);


$failable = ["title", "excerpt", "content", "email"];

$data = load($failable);


$validate = new Validator();

$validation = $validate->validate($data, [
    'title' =>[
        'required' => true,
        'min' =>5
    ],
    'excerpt' =>[
        'required' =>true,
        'min' =>5,
        'max' => 190

    ],
    'content' =>[
        'required' =>true,
        'min' =>10
    ],

    'email' => [
        'email' => true
      ] ,

    'password' => [
      'required' =>true,
      'min' =>6
      ],

      'repassword' => [
      'match' => 'password'
    ]

    ]);


    if(!$validation->hasError()){
    //    print_arr($validation->getError());

        if($db->query("insert  into `posts`(`title`, `excerpt`, `content`) values( :title, :excerpt, :content) ",
        $data))
        
        {
          $_SESSION['success'] = "ok";
        }
        else{
           $_SESSION['error'] = "Db error";
        }

        redirect('/');
      }else {

        require VIEWS .'/posts/create.tpl.php';

      }







