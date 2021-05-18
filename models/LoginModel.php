<?php
class LoginModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function loginCustomer($email, $password)
    {
        $statement = "SELECT * FROM customers WHERE email = :email";

        $parameters = array(":email" => $email);
        $customer = $this->db->select($statement, $parameters)[0];
    
        if (empty($customer) || !password_verify($password, $customer['password'])) {
            throw new Exception("Email or password is wrong");
        }

        return $customer;
    }
}
