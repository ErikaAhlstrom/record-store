<?php
session_start();
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $email = $this->sanitize($_POST['email']);
            $password = $this->sanitize($_POST['password']);
            try {
                $customer = $this->model->loginCustomer($email, $password);
                $_SESSION['customer'] = $customer;
                $destination = URLROOT;
                header("Location: $destination");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
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
