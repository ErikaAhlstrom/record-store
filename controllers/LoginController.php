<?php
class LoginController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function login()
    {
        $this->getHeader("Login");
        $this->getLoginForm();
        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }


    private function getLoginForm()
    {
        $this->view->viewLoginForm();
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    /**
     * Sanitize Inputs
     * https://www.w3schools.com/php/php_form_validation.asp
     */
    public function sanitize($text)
    {
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        return $text;
    }
}
