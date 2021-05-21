<?php

class RegisterControllerTEST extends SuperController
{

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->registration();
        }
        $this->getHeader("Login");
        $this->getRegisterForm();
        $this->getFooter();
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
            $url = $this->destination . "login";
            header("Location: $url");
            die();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function getRegisterForm()
    {
        $this->view->viewRegisterForm();
    }
}
