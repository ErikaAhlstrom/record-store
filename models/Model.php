<?php

class Model
{

    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function fetchAllRecords()
    {
        $records = $this->db->select(
            "SELECT records.title, records.description, records.price, records.id_record, records.cover, records.year_released, 
            GROUP_CONCAT(artists.name SEPARATOR ', ') AS name
            FROM records 
            LEFT JOIN records_has_artists ON records_has_artists.id_record = records.id_record 
            LEFT JOIN artists ON artists.id_artist = records_has_artists.id_artist GROUP BY records.id_record
        "
        );
        return $records;
    }

    public function fetchMovieById($id)
    {
        $statement = "SELECT * FROM films WHERE film_id = :id";
        $params = array(":id" => $id);
        $movie = $this->db->select($statement, $params);
        // print_r($movie);
        return $movie[0] ?? false;
    }

    public function fetchCustomerById($id)
    {
        $statement = "SELECT * FROM customers WHERE customer_id=:id";
        $parameters = array(':id' => $id);
        $customer = $this->db->select($statement, $parameters);
        return $customer[0] ?? false;
    }

    public function addToCart($customer_id, $record_id, $amount)
    {
        $statement = "INSERT INTO carts (id_customer, id_record, amount) 
                        VALUES (:id_customer, :id_record, :amount)";
        $params = array(
            ':id_customer' => $customer_id,
            ':id_record' => $record_id,
            'amount' => $amount
        );

        $cart = $this->db->insert($statement, $params);
        return $cart;
    }
}
