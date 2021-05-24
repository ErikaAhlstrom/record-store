<?php
class RegisterView
{
    public function viewHeader($title)
    {
        include_once("views/partials/header.php");
    }

    public function viewFooter()
    {
        include_once("views/partials/footer.php");
    }

    public function viewRegisterForm($customer, $errors)
    {
        include_once("views/partials/registerForm.php");
    }
}
