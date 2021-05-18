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
            GROUP_CONCAT(artists.name) AS name
            FROM records 
            LEFT JOIN records_has_artists ON records_has_artists.id_record = records.id_record 
            LEFT JOIN artists ON artists.id_artist = records_has_artists.id_artist GROUP BY records.id_record
        "
        );
        return $records;
    }

    public function fetchAllGenres()
    {
        $genres = $this->db->select("SELECT * FROM genres");
        return $genres;
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


    public function saveOrder($customer_id, $movie_id)
    {
        $customer = $this->fetchCustomerById($customer_id);
        if (!$customer) return false;

        $statement = "INSERT INTO orders (customer_id, film_id)  
                      VALUES (:customer_id, :film_id)";
        $parameters = array(
            ':customer_id' => $customer_id,
            ':film_id' => $movie_id
        );

        // Ordernummer
        $lastInsertId = $this->db->insert($statement, $parameters);

        return array('customer' => $customer, 'lastInsertId' => $lastInsertId);
    }
}
