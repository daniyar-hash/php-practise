<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




use myframew\Validator;

$db = \myframew\App::get(\myframew\Db::class);


$failable = ["title", "excerpt", "content"];

$data = load($failable);

// dump($data);


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



    // print_arr($validation->getError());

    if(!$validation->hasError()){


         $data['slug'] = strtolower(preg_replace('/\s+/', '-', $data['title']));

        
        if($db->query("insert  into `posts`(`title`, `excerpt`, `content`, `slug`) values( :title, :excerpt, :content, :slug) ",
        $data))
        
        {

          $_SESSION['success'] = "ok";
        }
        else{
           $_SESSION['error'] = "Db error";
        }

        redirect('/');
      }
      
      else {

        require VIEWS .'/posts/create.tpl.php';

      }







