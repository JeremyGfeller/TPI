<?php
    require_once('fonction.php');
    connectDB();   
    extract($_POST);

    $tables = json_decode($update);

    foreach($tables as $update)
    {
        $query = "INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ('1', '".$update -> id_wine."', '".$update -> newQuantity."', '0');";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }
    echo json_encode('ok');
?>