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
        $this->getHeader("Login");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $this->sanitize($_POST['email']);
            $password = $this->sanitize($_POST['password']);
            try {
                $customer = $this->model->loginCustomer($email, $password);
                session_start();
                session_unset();
                $_SESSION['customer'] = $customer;
                $destination = URLROOT;
                header("Location: $destination");
            } catch (Exception $e) {

                $this->getLoginForm($e->getMessage());
            }
        } else $this->getLoginForm();

        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getLoginForm($errors = false)
    {
        $this->view->viewLoginForm($errors);
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
