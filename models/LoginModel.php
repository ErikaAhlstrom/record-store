<?php
class LoginModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function loginCustomer(/*kanskeparameterhär*/)
    {
        // Kolla om customer finns och returnera true or false 
    }
}
