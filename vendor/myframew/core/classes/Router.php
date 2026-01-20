<?php

namespace myframew;


class Router 
{

    protected $routes = [];
    protected $uri;
    protected $method;


    public function  __construct()
    {
        
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function match()
    {

        $matches = false;
    
        foreach($this->routes as $route){

            if(($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))){

            if($route['middleware']){
                $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                if(!$middleware){
                    echo 'hear';
                    throw new \Exception("Incorrect middleware {$route['middleware']}");
                }


                (new $middleware)->handle();
                
            }


            // if($route['middleware'] ==='guest'){
            //         if(check_auth()){
            //             redirect('/');
            //         }

            // }

            // if($route['middleware'] ==='auth'){
            //         if(!check_auth()){
            //             redirect('/register');
            //         }

            // }


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
          return $this;
        //  dump($this->routes);
    
    }



    public function add($uri, $controlller, $method)
    {


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


}
