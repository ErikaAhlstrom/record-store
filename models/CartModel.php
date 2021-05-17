<?php

class CartModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function fetchCartById($id)
    {
        $statement = "SELECT * FROM carts WHERE id_customer = :id";
        $params = array(":id" => $id);
        $cart = $this->db->select($statement, $params);
        //print_r($record);
        return $cart[0] ?? false;
    }

    // public function fetchRecordById($id)
    // {
    //     $statement = "SELECT * FROM records WHERE id_record = :id";
    //     $params = array(":id" => $id);
    //     $record = $this->db->select($statement, $params);
    //     //print_r($record);
    //     return $record[0] ?? false;
    // }

    public function fetchCustomerById($id)
    {
        $statement = "SELECT * FROM customers WHERE id_customer=:id";
        $parameters = array(':id' => $id);
        $customer = $this->db->select($statement, $parameters);
        return $customer[0] ?? false;
    }


    public function saveOrder($customer_id, $record_id)
    {
        $customer = $this->fetchCustomerById($customer_id);
        if (!$customer) return false;

        $statement = "INSERT INTO orders (id_customer, id_record)  
                      VALUES (:id_customer, :id_record)";
        $parameters = array(
            ':id_customer' => $customer_id,
            ':id_record' => $record_id
        );

        // Ordernummer
        $lastInsertId = $this->db->insert($statement, $parameters);

        return array('customer' => $customer, 'lastInsertId' => $lastInsertId);
    }
}
