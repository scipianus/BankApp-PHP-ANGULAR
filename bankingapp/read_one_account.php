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
    // read the details of the account to be edited
    $account->readOne();
    // create array
    $account_arr[] = array(
        "id" =>  $account->id,
        "iban" => $account->iban,
        "type" => $account->type,
        "currency" => $account->currency,
        "amount" => $account->amount
    );
    // make it json format
    print_r(json_encode($account_arr));
?>