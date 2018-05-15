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
$query = "select id_users, first_name, last_name, login, password, role from users where id_users = $id;";
            
$quantitys = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

/* Save the data in a array */
while($quantity = $quantitys->fetch()) //fetch = aller chercher
{
    extract($quantity); // $id_users, $first_name, $last_name, $login, $role
    
    $arr = array('id_users' => $id_users, 'first_name' => $first_name, 'last_name' => $last_name, 'login' => $login, 'role' => $role);

    echo json_encode($arr);
}

?>