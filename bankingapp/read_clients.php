<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 
    // include database and object files 
    include_once 'config/database.php'; 
    include_once 'objects/client.php'; 
    // instantiate database and client object 
    $database = new Database(); 
    $db = $database->getConnection();
    // initialize object
    $client = new Client($db);
    // query clients
    $stmt = $client->readAll();
    $num = $stmt->rowCount();
    $data="";
    // check if more than 0 record found
    if($num>0){
        $x=1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $data .= '{';
                $data .= '"id":"'  . $id . '",';
                $data .= '"firstname":"' . $firstname . '",';
                $data .= '"lastname":"' . $lastname . '"';
            $data .= '}'; 
            $data .= $x < $num ? ',' : ''; $x++; } 
    } 
    // json format output 
    echo '{"records":[' . $data . ']}'; 
?>