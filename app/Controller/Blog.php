<?php
namespace App\Controller;
use Base\AbstractController;

class Blog extends AbstractController
{
    function indexAction()
    {
        if ($this->user) {
            $this->redirect("/user/register");
        }
        echo __METHOD__;
    }
}