<?php



function dump($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    

   
}


function print_arr($arr)
{

    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function dd($data){
    
    dump($data);
    die;
}

function abort($code =404)
{

    http_response_code(404);
    require VIEWS . "/errors/{$code}.tpl.php";
    die;
}

function load($fillable = [])
{

    $data = [];

    foreach($_POST as $key=>$val)
    {
     
        if(in_array($key, $fillable)){
            $data[$key] = trim($val);
        }
      
        
    }

      return $data;

    }

function old($fieldname)
{


     return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : "";
   
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);

}

function redirect($url = '')
{
    if($url){
        $redirect = $url;
    }
    else{
        $redirect = isset($_SERVER['HTTP-REFERER']) ? $_SERVER['HTTP-REFERER'] : PATH;

    }

    header("Location: {$redirect}");
    die;
}

function getAlerts()
{

    if(!empty($_SESSION['error'])){

        require_once  VIEWS .'/incs/alert_error.php';
        unset($_SESSION['error']);

    }

    if(!empty($_SESSION['success'])){

        require_once  VIEWS .'/incs/alert_success.php';
        unset($_SESSION['success']);

    }

        
}

function db()
{
    return \myframew\App::get(myframew\Db::class);
}

function check_auth()
{
    return isset($_SESSION['user']);
}



