<?php 
    // get database connection 
    include_once 'config/database.php'; 
    $database = new Database(); 
    $db = $database->getConnection();
    // instantiate client object
    include_once 'objects/client.php';
    $client = new Client($db);
    // get posted data
    $data = json_decode(file_get_contents("php://input")); 
    // set client property values
    $client->first_name = $data->firstname;
    $client->last_name = $data->lastname;
    $client->created = date('Y-m-d H:i:s');
    // create the client
    if($client->create()) {
        echo "Client was created.";
    }
    // if unable to create the client, tell the user
    else {
        echo "Unable to create client.";
    }
?>