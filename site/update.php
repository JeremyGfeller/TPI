<?php
    require_once('fonction.php');
    connectDB();   

    $query = "UPDATE vintage SET quantity = $newQuantity WHERE id_vintage = $id_wine;";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
?>