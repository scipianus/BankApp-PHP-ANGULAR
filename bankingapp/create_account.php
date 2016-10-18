<?php 
    // get database connection 
    include_once 'config/database.php'; 
    $database = new Database(); 
    $db = $database->getConnection();
    // instantiate account object
    include_once 'objects/account.php';
    $account = new Account($db);
    // get posted data
    $data = json_decode(file_get_contents("php://input")); 
    // set client property values
    $account->client_id = $data->clientId;
    $account->iban = $data->iban;
    $account->type = $data->type;
    $account->currency = $data->currency;
    $account->amount = $data->amount;
    $account->created = date('Y-m-d H:i:s');
    // create the account
    if($account->create()) {
        echo "Account was created.";
    }
    // if unable to create the account, tell the user
    else {
        echo "Unable to create account.";
    }
?>