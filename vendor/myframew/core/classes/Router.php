<?php

namespace myframew;


class Router 
{

    protected $routes = [];
    protected $uri;
    protected $method;
    public static $params_uri = [];

    


    public function  __construct()

    {
      
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $this->method = $this->getMethod();
       
    }

    protected function getMethod()
    {
         $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
         return strtoupper($method);
    }

    public function match()
    {

        $matches = false;
      
      

        foreach($this->routes as $route){
        
             if((preg_match("#^{$route['uri']}$#", $this->uri, $params)) && (in_array($this->method, $route['method']))){

               
     
                if($route['middleware']){
            
                    $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                    if(!$middleware){
                    
                        throw new \Exception("Incorrect middleware {$route['middleware']}");
                    }

                    (new $middleware)->handle();
                    
                }

                if($route['middleware'] ==='guest'){
                        if(check_auth()){
                            redirect('/');
                        }

                }

                if($route['middleware'] ==='auth'){
                        if(!check_auth()){
                            redirect('/register');
                        }

                }

                foreach($params as $k=>$v){
                    if(is_string($k))
                        self::$params_uri[$k] = $v;

                }

                
                require CONTROLLERS . "/{$route['controller']}";
                // dd($route);
                $matches = true;
                break;

            }


        }

                
            if(!$matches){
                abort();
            }

        
    }

    

    public function only($middleware)
    {

          $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
       //   dump($this->routes);
          return $this;
          
    
    }

    public function add($uri, $controlller, $method)
    {


            if(is_array($method)){
                $method = array_map('strtoupper' ,$method);
            }

            else{
                $method = [$method];  //  $method = ['GET']
            }





        $this->routes[] =[
            'uri' => $uri,
            'controller' => $controlller,
            'method' => $method,
            'middleware' =>null
        ];

        return $this;


    }

    public function get($uri, $controlller)

    {
        return $this->add($uri, $controlller, 'GET');
    
    }

    public function post($uri, $controlller)
    
    {

        return $this->add($uri, $controlller, 'POST');
    }

    public function delete($uri, $controlller)
    
    {
       return $this->add($uri, $controlller, 'DELETE');
    }

    public function getRoutes():array
    {

    return $this->routes;

    }


}
