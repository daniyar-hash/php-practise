<?php



use myframew\Validator;

$title = "Page: Login";



if($_SERVER['REQUEST_METHOD'] =='POST'){


$db = \myframew\App::get(\myframew\Db::class);

$failable = ["password", "email", "avatar"];

$data = load($failable);




$validate = new Validator();

$validation = $validate->validate($data, [

    'password' =>[
        'required' =>true,


    ],

    'email' => [
        'email' => true,
              ] ,

    ]);

    if(!$validation->hasError()){


    if(!$user = $db->query("SELECT * from users where email = ?", [$data['email']])->find()){

           $_SESSION['error'] = "Wrong email or password, please try again";
            redirect();
      }

    if(!password_verify($data['password'], $user['password'])){

         $_SESSION['error'] = "Wrong email or password, please try again";
            redirect();

     }

    foreach($user as $key=>$value){
      
      if($key !='password'){
         $_SESSION['user'][$key] = $value;
      }
   
    }

    
      $_SESSION['success'] = "Successfull login";
      redirect(PATH);



    }
        
  }


require_once VIEWS . '/users/login.tpl.php';