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
        $statement = "SELECT carts.amount, carts.id_customer, records.title, records.price, records.id_record, records.cover, 
        GROUP_CONCAT(artists.name SEPARATOR ', ') AS name 
        FROM carts 
        LEFT JOIN records ON records.id_record = carts.id_record 
        LEFT JOIN records_has_artists ON records_has_artists.id_record = records.id_record 
        LEFT JOIN artists ON artists.id_artist = records_has_artists.id_artist 
        WHERE carts.id_customer = $id 
        GROUP BY carts.id_record
        ";
        $params = array(":id" => $id);
        $cart = $this->db->select($statement, $params);
        return $cart ?? false;
    }

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


        // Skapa order_details
        foreach ($carts as $cart) {

            $statement = "INSERT INTO order_details 
            (orders_id_order, records_id_record, amount)  
            VALUES (:orders_id_order, :records_id_record, :amount)";
            $parameters = array(
                ':orders_id_order' => $lastInsertId,
                ':records_id_record' => $cart['id_record'],
                ':amount' => $cart['amount']
            );
            $this->db->insert($statement, $parameters);

            // Kolla om vi fick tillbaka id, lägg till i $confirmed array           
        }

        return $lastInsertId;
    }

    public function deleteCarts($customer_id)
    {
        $statement = "DELETE FROM carts WHERE id_customer = :customer_id";
        $parameters = array(
            ':customer_id' => $customer_id
        );
        $this->db->delete($statement, $parameters);
    }
}
