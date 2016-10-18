<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 
    // include database and object files 
    include_once 'config/database.php'; 
    include_once 'objects/account.php'; 
    // instantiate database and account object 
    $database = new Database(); 
    $db = $database->getConnection();
    // initialize object
    $account = new Account($db);
    // set query param
    $account->client_id = $_GET["clientId"];
    // query accounts
    $stmt = $account->readAll();
    $num = $stmt->rowCount();
    $data="";
    // check if more than 0 record found
    if($num>0){
        $x=1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $data .= '{';
                $data .= '"id":"'  . $id . '",';
                $data .= '"iban":"' . $iban . '",';
                $data .= '"type":"' . $type . '",';
                $data .= '"currency":"' . $currency . '",';
                $data .= '"amount":"' . $amount . '"';
            $data .= '}'; 
            $data .= $x < $num ? ',' : ''; $x++; } 
    } 
    // json format output 
    echo '{"records":[' . $data . ']}'; 
?>