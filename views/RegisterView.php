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

    public function viewRegisterForm()
    {
        include_once("views/partials/registerForm.php");
    }
}
