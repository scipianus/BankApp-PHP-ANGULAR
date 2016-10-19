<?php 
    // include database and object files 
    include_once 'config/database.php'; 
    include_once 'objects/account.php'; 
    // get database connection 
    $database = new Database(); 
    $db = $database->getConnection();
    // prepare account object
    $account = new Account($db);
    // get id of account to be edited
    $data = json_decode(file_get_contents("php://input"));     
    // set ID property of account to be edited
    $account->id = $data->id;
    // set account property values
    $account->iban = $data->iban;
    $account->type = $data->type;
    $account->currency = $data->currency;
    $account->amount = $data->amount;
    // update the account
    if($account->update()){
        echo "Account was updated.";
    }
    // if unable to update the account, tell the user
    else{
        echo "Unable to update account.";
    }
?>