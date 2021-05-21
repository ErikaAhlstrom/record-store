<?php

class AdminModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function loginAdmin($username, $password)
    {
        $statement = "SELECT * FROM admin WHERE username = :username";

        $parameters = array(":username" => $username);
        $admin = $this->db->select($statement, $parameters)[0];

        if (empty($admin) || !password_verify($password, $admin['password'])) {
            throw new Exception("Email or password is wrong");
        }

        return $admin;
    }

    public function fetchAllRecords()
    {
        $records = $this->db->select(
            "SELECT * FROM records 
        JOIN records_has_artists 
        ON records.id_record=records_has_artists.id_record 
        JOIN artists 
        ON records_has_artists.id_artist=artists.id_artist
        "
        );
        return $records;
    }

    public function fetchAllArtists()
    {
        $artists = $this->db->select(
            "SELECT * FROM artists"
        );
        return $artists;
    }

    public function fetchRecordById($id) 
    {
        $statement = "SELECT r.title, r.description, r.price, r.year_released, r.stock, a.id_artist, a.name, g.id_genre, g.genre FROM records r
        JOIN records_has_artists rha
        ON r.id_record=rha.id_record 
        JOIN artists a
        ON rha.id_artist=a.id_artist
        JOIN records_has_genres rhg
        ON r.id_record = rhg.id_record
        JOIN genres g
        on rhg.id_genre = g.id_genre
        WHERE r.id_record = :id";
        $parameters = array(":id" => $id);
        $record = $this->db->select($statement, $parameters);
        return $record;
    }

    public function updateRecord($id, $record) {
        $statement = "UPDATE records
        SET title = :title, description = :description, price = :price, year_released = :year_released, stock = :stock 
        WHERE id_record = :id";
        $parameters = array(
            ":title" => $record['title'],
            ":description" => $record['description'],
            ":price" => $record['price'],
            ":year_released" => $record['year_released'],
            ":stock" => $record['stock'],
            ":id" => $id
        );
        $this->db->update($statement, $parameters);
    }

    public function updateRecordsHasArtists($id_record, $id_artist) {
        $statement = "UPDATE records_has_artists SET id_artist = :id_artist WHERE id_record = :id_record";
        $parameters = array(":id_artist" => $id_artist, ":id_record" => $id_record);
        $this->db->update($statement, $parameters);
    }

    public function fetchRecordsHasArtistsById($id_record) {
        $statement = "SELECT * FROM records_has_artists WHERE id_record = :id_record";
        $parameters = array(":id_record" => $id_record);
        $records_has_artists = $this->db->select($statement, $parameters);
        return $records_has_artists;
    }

    public function fetchArtistByName($name) {
        $statement = "SELECT * FROM artists WHERE name = :name";
        $parameters = array(':name' => $name);
        $artist = $this->db->select($statement, $parameters);
        return $artist;
    }

    public function insertArtist($name) {
        $statement = "INSERT INTO artists (name) VALUES (:name)";
        $parameters = array(':name' => $name);
        return $this->db->insert($statement, $parameters);
    }

    public function fetchAllOrders()
    {
        $orders = $this->db->select(
            "SELECT o.id_order, o.sent, o.timestamp, CONCAT(c.firstname, ' ', c.lastname) AS name 
            FROM orders o 
            JOIN customers c 
            ON o.id_customer = c.id_customer
            ORDER BY o.sent ASC
            ");
        return $orders;
    }

    public function fetchOrderById($id)
    {
        $statement = "SELECT orders.id_order, records.title, records.id_record, order_details.amount, orders.sent FROM orders 
        JOIN order_details ON order_details.orders_id_order = orders.id_order 
        JOIN records ON records.id_record = order_details.records_id_record 
        WHERE orders.id_order = :id";
        $parameters = array(":id" => $id);
        $order = $this->db->select($statement, $parameters);
        return $order;
    }

    public function setToSent($id) {
        $statement = "UPDATE orders SET sent = 1 WHERE id_order = :id";
        $parameters = array(":id" => $id);
        $this->db->update($statement, $parameters);
    }
}
