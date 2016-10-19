<?php 
    // include database and object file 
    include_once 'config/database.php'; 
    include_once 'objects/account.php'; 
    // get database connection 
    $database = new Database(); 
    $db = $database->getConnection();
    // prepare account object
    $account = new Account($db);
    // get account id
    $data = json_decode(file_get_contents("php://input"));     
    // set account id to be deleted
    $account->id = $data->id;
    // delete the account
    if($account->delete()){
        echo "Account was deleted.";
    }
    // if unable to delete the account
    else{
        echo "Unable to delete account.";
    }
?>