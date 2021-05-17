<?php
class RegisterModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function registerCustomer(/*kanskeparameterhär*/)
    {
        // Kolla om customer finns annars skapa!
    }
}
