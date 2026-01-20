<?php

namespace myframew\middleware;

class Guest
{

    public function handle()
    {
         if(check_auth()){
            redirect('/');
        }
    }


}