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
