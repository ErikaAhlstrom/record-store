<?php
class RegisterModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function registerCustomer($firstName, $lastName, $email, $phone, $password)
    {
        if ($this->userCheck($email)) {
            throw new Exception("Email already exist");
        }

        $statement = "INSERT INTO customers (firstName, lastName, email, phone_number, password)
                      VALUES (:firstName, :lastName, :email, :phone, :password)";
        $parameters = array(':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':phone' => $phone, ':password' => $password);

        return $this->db->insert($statement, $parameters);
    }

    private function userCheck($email)
    {
        $statement = "SELECT * FROM customers WHERE email = :email";
        $parameters = array(":email" => $email);
        $customer = $this->db->select($statement, $parameters);
        return count($customer) != 0;
    }
}
