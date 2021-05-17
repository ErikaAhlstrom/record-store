<?php
class LoginView
{
    public function viewHeader($title)
    {
        include_once("views/partials/header.php");
    }

    public function viewFooter()
    {
        include_once("views/partials/footer.php");
    }

    public function viewLoginForm()
    {
        include_once("views/partials/loginForm.php");
    }
}
