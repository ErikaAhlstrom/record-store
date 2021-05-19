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


    public function saveOrder($customer_id, $carts)
    {
        // Skapa en order
        $statement = "INSERT INTO orders (id_customer, sent)  
                      VALUES (:id_customer, :sent)";            
        $parameters = array(':id_customer' => $customer_id, ':sent' => 0);

        // Ordernummer
        $lastInsertId = $this->db->insert($statement, $parameters);
        echo $lastInsertId;

        // Skapa order_details

        // Samla alla confirmed databas interaktioner för att se att alla order details rader kunde läggas till.
        $confirmed = Array();
        foreach ($carts as $cart) {
            
            $statement = "INSERT INTO order_details 
            (orders_id_order, records_id_record, amount)  
            VALUES (:orders_id_order, :records_id_record, :amount)";
            $parameters = array(
                ':orders_id_order' => $lastInsertId,
                ':records_id_record' => $cart['id_record'],
                ':amount' => $cart['amount']);
            $lastInsertDetailId = $this->db->insert($statement, $parameters);
            // Kolla om vi fick tillbaka id, lägg till i $confirmed array
            if($lastInsertDetailId) {
                array_push($confirmed, $lastInsertDetailId);
            }           
        }
        // order_detailsnummer
        if(count($confirmed) == count($carts)) {
            return $lastInsertId;
        }
        else return null;
    }
}
