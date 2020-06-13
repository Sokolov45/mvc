<?php
namespace controllers;

class User
{
    public $view;

    public function registerFormAction()
    {
        include "../app/views/registerForm.html";

    }
}