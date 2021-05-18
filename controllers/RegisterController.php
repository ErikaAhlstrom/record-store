<?php
class RegisterController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->registration();
        }
        $this->getHeader("Login");
        $this->getRegisterForm();
        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function registration()
    {
        $firstName = $this->sanitize($_POST['firstName']);
        $lastName = $this->sanitize($_POST['lastName']);
        $email = $this->sanitize($_POST['email']);
        $phone = $this->sanitize($_POST['phone']);
        $password = $this->sanitize($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $this->model->registerCustomer($firstName, $lastName, $email, $phone, $password);
            $destination = URLROOT;
            header("Location: $destination/login");
            die();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function getRegisterForm()
    {
        $this->view->viewRegisterForm();
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
