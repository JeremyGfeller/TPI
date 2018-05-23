<?php
    require_once('fonction.php');
    connectDB();    

    $id_wine = $_POST['idWine'];
    $quantity = $_POST['quantity'];
    $pseudo = $_POST['pseudo'];
    $date = date('Y-m-d');
    
    $query = "INSERT INTO movement (fk_users, fk_vintage, movement_out, date) VALUES ((select id_users from users where login = '$pseudo'), '$id_wine', '$quantity', '$date');";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

    $query = "UPDATE vintage SET quantity = quantity - $quantity, date = now() WHERE id_vintage = $id_wine;";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

    echo json_encode("Les bouteilles ont été retirée !");
?>