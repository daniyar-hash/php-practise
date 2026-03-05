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

function load($fillable = [], $post = true)
{

    $data = [];

    $load_data = $post ? $_POST : $_GET;
 
    foreach($fillable as $key_name){

        if(isset($load_data[$key_name])){

            if(!is_array($load_data[$key_name])){
                $data[$key_name] = trim($load_data[$key_name]);
            }else{
                $data[$key_name] = $load_data[$key_name];
            }
           

        }else{
            $data[$key_name] = "";
        }
    }
   


    // foreach($load_data as $key=>$val)
    // {
     
    //     if(in_array($key, $fillable)){
    //         $data[$key] = trim($val);
    //     }
      
        
    // }

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

        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;

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

function get_file_ext($file_name)
{
   $file_ext = explode('.', $file_name);
   return end($file_ext);
}

function getParams()
{
    return \myframew\Router::$params_uri;
}

function getParam(string $key, $default = null)
{

  return \myframew\Router::$params_uri[$key] ?? $default;

}



