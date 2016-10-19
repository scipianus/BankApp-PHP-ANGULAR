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
    
    function readOne()
    {
        // query to read single record
        $query = "SELECT iban, type, currency, amount FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // bind id of account to be updated
        $stmt->bindParam(":id", $this->id);
        // execute query
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->iban = $row['iban'];
        $this->type = $row['type'];
        $this->currency = $row['currency'];
        $this->amount = $row['amount'];
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
    
    function update()
    {
        // query to update record
        $query = "UPDATE " . $this->table_name . " SET iban=:iban, type=:type, currency=:currency, amount=:amount WHERE id=:id";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":iban", $this->iban);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":currency", $this->currency);
        $stmt->bindParam(":amount", $this->amount);
        // execute query
        if($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }
    
    function delete() 
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of record to delete
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>