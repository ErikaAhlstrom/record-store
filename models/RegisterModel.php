<?php
class RegisterModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function registerCustomer($customer)
    {
        $statement = "INSERT INTO customers (firstName, lastName, email, phone_number, password)
                      VALUES (:firstName, :lastName, :email, :phone, :password)";
        $parameters = array(':firstName' => $customer['firstName'], ':lastName' => $customer['lastName'], ':email' => $customer['email'], ':phone' => $customer['phone'], ':password' => $customer['password']);

        return $this->db->insert($statement, $parameters);
    }

    public function userCheck($email)
    {
        $statement = "SELECT * FROM customers WHERE email = :email";
        $parameters = array(":email" => $email);
        $customer = $this->db->select($statement, $parameters);
        return count($customer) != 0;
    }
}
