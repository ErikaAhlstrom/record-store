<?php
session_start();
class LoginControllerTEST extends SuperController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $this->sanitize($_POST['email']);
            $password = $this->sanitize($_POST['password']);
            try {
                $customer = $this->model->loginCustomer($email, $password);
                $_SESSION['customer'] = $customer;
                header("Location: $this->destination");
                die();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->getHeader("Login");
        $this->getLoginForm();
        $this->getFooter();
    }

    private function getLoginForm()
    {
        $this->view->viewLoginForm();
    }
}
