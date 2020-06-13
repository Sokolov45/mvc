<?php
namespace core;

class Router
{
    //    $requestFromUser = new Request();

    public function verificationOfAuthorization()
    {
        if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
            echo "ты здесь";
            include "../app/views/registerForm.html";
        }else{
            echo "вы зарегистрировались";
        }
    }


}
