<?php

namespace myframew\middleware;

class Auth
{

    public function handle()
    {
         if(!check_auth()){
            redirect('/register');
        }
    }


}