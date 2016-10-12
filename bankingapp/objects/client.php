<?php
class Client
{
    // database connection and table name 
    private $conn;
    private $table_name = "clients";
    // object properties 
    public $id;
    public $first_name;
    public $last_name;
    public $created;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    function readAll()
    {
        // select all query
        $query = "SELECT id, firstname, lastname, created FROM " . $this->table_name . " ORDER BY id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
    function create()
    {
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET firstname=:firstname, lastname=:lastname, created=:created";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        // bind values
        $stmt->bindParam(":firstname", $this->first_name);
        $stmt->bindParam(":lastname", $this->last_name);
        $stmt->bindParam(":created", $this->created);
        // execute query
        if($stmt->execute()) {
            return true;
        }else {
            echo "<pre>";
                print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }
}
?>