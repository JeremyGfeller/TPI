<?php
    require_once('fonction.php');
    connectDB();   
     
    $id_wine = $_POST['idWine'];
    $quantity = $_POST['quantity'];
    $provider = $_POST['provider'];
    $pseudo = $_POST['pseudo'];
    
    $query = "INSERT INTO movement (fk_users, fk_vintage, movement_in, provider_other) VALUES ((select id_users from users where login = '$pseudo'), '$id_wine', '$quantity', '$provider');";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

    $query = "UPDATE vintage SET quantity = quantity + $quantity, date = now() WHERE id_vintage = $id_wine;";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
?>