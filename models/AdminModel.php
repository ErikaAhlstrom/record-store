<?php

class AdminModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function loginAdmin(/*kanskeparameterhär*/)
    {
        // Kolla om admin finns och returnera true or false 
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
}
