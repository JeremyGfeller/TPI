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
extract($_GET);

/* Search in the base the data for an article */
$query = "select id_vintage, id_wine, name, provider, year, qr_code, quantity, price, date 
            from vintage 
            inner join wine on fk_wine = id_wine
            where id_vintage = $id;";
            
$wines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

/* Save the data in a array */
while($wine = $wines->fetch()) //fetch = aller chercher
{
    extract($wine); // $id_vintage, $id_wine, $name, $provider, $year, $qr_code, $quantity, $price, $date
    
    $arr = array('id_wine' => $id_wine, 'name'=> $name, 'year' => $year, 'quantity' => $quantity);

    echo json_encode($arr);
}

?>