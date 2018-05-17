<?php
    error_reporting(E_ERROR);
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origins, Content-Type");
    //die(json_encode(print_r($_POST,1)));

    $newQuantity = $_POST['quantity'];
    $id_wine = $_POST['wineid'];

    //error_log(print_r($_POST,1));

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

    $query = "UPDATE vintage SET quantity = $newQuantity WHERE id_vintage = $id_wine;";

    echo json_encode($query);
    
    $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
?>