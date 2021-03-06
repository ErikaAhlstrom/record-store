<?php

/*******************************************
 * 
 *     A General Purpose Database Class
 * 
 ******************************************/

class Database
{

    private $conn = null;

    public function __construct($database, $username = "root", $password = "root", $servername = "localhost")
    {
        // Data Source Name
        $dsn = "mysql:host=$servername;dbname=$database;charset=UTF8";

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * En instansmetod som exekverar en PDO-sats
     */
    private function execute($statement, $input_parameters = [])
    {
        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute($input_parameters);
            return $stmt;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            throw new Exception($e->getMessage());
        }
    }

    /**
     * SELECT
     */
    public function select($statement, $input_parameters = [])
    {
        $stmt = $this->execute($statement, $input_parameters);
        return $stmt->fetchAll();
        // https://www.php.net/manual/en/pdostatement.fetchall
    }


    /**
     * INSERT
     */
    public function insert($statement, $input_parameters = [])
    {
        $this->execute($statement, $input_parameters);
        return $this->conn->lastInsertId();
        // https://www.php.net/manual/en/pdo.lastinsertid
    }

    /**
     * UPDATE
     */
    public function update($statement, $input_parameters = [])
    {
        $this->execute($statement, $input_parameters);
    }

    /**
     * DELETE
     */
    public function delete($statement, $input_parameters = [])
    {
        $this->execute($statement, $input_parameters);
    }
}
