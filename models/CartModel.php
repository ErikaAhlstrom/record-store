<?php

class CartModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }
    // Hämtar cart via custumor id från SESSION
    public function fetchCartByCustomerId($id)
    {
        $statement = "SELECT carts.amount, carts.id_customer, records.title, records.price, records.id_record, records.cover, GROUP_CONCAT(artists.name SEPARATOR ', ')AS name FROM carts LEFT JOIN records ON records.id_record = carts.id_record LEFT JOIN records_has_artists ON records_has_artists.id_record = records.id_record LEFT JOIN artists ON artists.id_artist = records_has_artists.id_artist WHERE carts.id_customer = $id GROUP BY carts.id_record
        ";
        $params = array(":id" => $id);
        $cart = $this->db->select($statement, $params);
        return $cart ?? false;
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
