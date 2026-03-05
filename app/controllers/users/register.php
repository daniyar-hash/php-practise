<?php


use myframew\Validator;

$title = "Page: Register";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] =='POST'){


$db = \myframew\App::get(\myframew\Db::class);


// $failable = ["name", "password", "email", "avatar"];

$data = load(["name", "password", "email"]);


// dump($_POST);
// dump($_FILES);



if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] ===0){

    $data['avatar'] = $_FILES['avatar'];
}else{
      $data['avatar'] = [];
}



$validate = new Validator();


$validation = $validate->validate($data, [
    'name' =>[
        'required' => true,
        'max' =>100
    ],
    'password' =>[
        'required' =>true,
        'min' => 6

    ],

    'email' => [
        'email' => true,
        'max' =>100,
        'unique' => 'users:email'


      ],

      'avatar' => [
        // 'required' => true,
        'ext' => 'jpg|gif',
        'size' => 1048576,
      ],

    ]);

        

    // dd($validation->getError());
    
    if(!$validation->hasError()){

       $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //    print_arr($validation->getError());

          // dump($data);

        if($db->query("insert  into `users`(`name`, `password`, `email`) VALUES (?, ?, ?)",
        [$data['name'], $data['password'], $data['email'] ]))
        
        {

        if(!empty($data['avatar']['name'])){

          $user_id = $db->get_user_id();

          $file_ext = get_file_ext($data['avatar']['name']);
       
           $dir = '/avatar/' . date('Y') . '/' . date('m') . '/' . date('d');

           if(!is_dir(UPLOADS . $dir)){

               mkdir(UPLOADS . $dir, 0755, true);

           }

           $file_path = UPLOADS . $dir . "/avatar-{$user_id}." . $file_ext;
           $file_url = "/uploads$dir/avatar-$user_id.$file_ext";

          //  dump($file_path);
          //  dump($file_url);
          //  dump($data['avatar']);

           if(move_uploaded_file($data['avatar']['tmp_name'], $file_path)){

              $db->query("update users set avatar = ? where id= ?", [$file_url, $user_id]);

           }else{
                 error_log("[" . date("Y-m-d, H:i:s"). "] Error upload avatar:{$e->getMessage()} ". PHP_EOL, 3, ERRORS_FILE);
           }
        }

          
          $_SESSION['success'] = "Вы успешно зарегистрировались";
        }
        else{
           $_SESSION['error'] = "Db error";
        }

         redirect(PATH);

      }

}



require_once VIEWS . '/users/register.tpl.php';