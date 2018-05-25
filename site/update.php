<?php
    require_once('fonction.php');
    connectDB();   
    extract($_POST);

    $query = "UPDATE vintage SET quantity = $quantity WHERE id_vintage = $wineid;";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
?>