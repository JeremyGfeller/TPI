<?php
    require_once('fonction.php');
    connectDB();    
    extract($_POST);

    $tables = json_decode($movements);

    error_log($movements, 0);
    
    foreach($tables as $movement)
    {
        $query = "INSERT INTO movement (fk_users, fk_vintage, nb_bottles, movement_type) VALUES ((select id_users from users where login = '".$movement -> login."'), '".$movement -> id_wine."', '".$movement -> nb_bottle."', '".$movement -> movement_type."');";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }
    echo json_encode("ok");
?>