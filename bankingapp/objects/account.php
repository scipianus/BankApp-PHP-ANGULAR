<?php
class Account
{
    // database connection and table name 
    private $conn;
    private $table_name = "accounts";
    // object properties 
    public $id;
    public $client_id;
    public $iban;
    public $type;
    public $currency;
    public $amount;
    public $created;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    function readAll()
    {
        // select all query
        $query = "SELECT id, iban, type, currency, amount FROM " . $this->table_name . " WHERE client_id = :client_id ORDER BY id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":client_id", $this->client_id);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
    function create()
    {
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET client_id=:client_id, iban=:iban, type=:type, currency=:currency, amount=:amount, created=:created";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->bindParam(":iban", $this->iban);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":currency", $this->currency);
        $stmt->bindParam(":amount", $this->amount);
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