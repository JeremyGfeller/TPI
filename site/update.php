<?php

    // Toutes les infos nécessaires pour la connexion à une base de donnée
    $hostname = 'localhost';
    $dbname = 'caveWine';
    $username = 'root';
    $password = '';

    // PDO = Persistant Data Object
    // Entre "" = Connection String
    $connectionString = "mysql:host=$hostname; dbname=$dbname";

    global $dbh; 

    try
    {
        $dbh = new PDO($connectionString, $username, $password);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $dbh->exec("SET NAMES UTF8");
    }
    catch(PDOException $e)
    {
        die("Erreur de connexion au serveur (".$e->getMessage().")");
    }

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origins, Content-Type");

    $newQuantity = $_POST['newQuantity'];
    $id_wine = $_POST['id_wine'];

    $query = "UPDATE vintage SET quantity = quantity - $newQuantity WHERE id_vintage = $id_wine;";
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    

?>