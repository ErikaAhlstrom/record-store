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
        $this->getHeader("Register");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->registration();
        } else {
            $this->getRegisterForm();
        }
        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function registration()
    {
        $customer = [];
        foreach ($_POST as $key => $value) {
            if (!$value) $empty = true;
            $customer[$key] = $this->sanitize($value);
        }

        if ($empty) $errors[] = "All fields are required";

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Email is not valid";

        if (strlen($_POST['password']) < 6) $errors[] = "Password to short";

        if ($this->model->userCheck($customer['email'])) $errors[] = "Email already exist";

        $customer['password'] = password_hash($customer['password'], PASSWORD_DEFAULT);

        if ($errors) $this->getRegisterForm($customer, $errors);
        else {
            $this->model->registerCustomer($customer);
            $destination = URLROOT . "login";
            header("Location: $destination");
            die();
        }
    }

    private function getRegisterForm($customer = false, $errors = false)
    {
        $this->view->viewRegisterForm($customer, $errors);
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
