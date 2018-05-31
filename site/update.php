<?php
    require_once('fonction.php');
    connectDB();   
    extract($_POST);

    $tables = json_decode($update);

    foreach($tables as $update)
    {
        $query = "UPDATE vintage SET quantity = ".$update -> newQuantity."$quantity WHERE id_vintage = ".$update -> id_wine.";";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }
    echo json_encode('ok');
?>