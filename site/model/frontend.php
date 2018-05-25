<?php
function connectDB()
{
    //Required datas for connect to a database
    $hostname = 'localhost';
    $dbname = 'caveWine';
    $username = 'root';
    $password = 'root';
 
    // PDO = Persistant Data Object
    // Between "" = Connection String
    $connectionString = "mysql:host=$hostname; dbname=$dbname";
 
    $dbh = new PDO($connectionString, $username, $password);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->exec("SET NAMES UTF8");
 
    return $dbh;
}

function newWine($wineName)
{
    $dbh = connectDB();
    $req = $dbh->query("SELECT id_wine, name FROM wine WHERE name = '$wineName';");
    $reqArray = $req->fetch();
 
    return $reqArray;   
}

function insertWine($typeWine, $wineName, $provider)
{
    $dbh = connectDB();
    $dbh->query("INSERT INTO wine (fk_typeWine, name, provider) VALUES ('$typeWine', '$wineName', '$provider');");
    
    return;
}

function selectVintage($wineName, $year)
{
    $dbh = connectDB();
    $req = $dbh->query("SELECT id_vintage, (SELECT id_wine from wine WHERE name = '$wineName') as fk_wine, year, quantity, price from vintage WHERE year = '$year';");
    $reqArray = $req->fetch();
 
    return $reqArray;  
}

function insertVintage($wineName, $year, $price, $quantity)
{
    $dbh = connectDB();
    $dbh->query("INSERT INTO vintage (fk_wine, year, quantity, price) VALUES ((SELECT id_wine from wine WHERE name = '$wineName'), '$year', '$quantity', '$price');");
    $dbh->query("UPDATE vintage SET qr_code = (SELECT id_vintage order by id_vintage DESC limit 1);");

    return;
}

function updateQRCode()
{
    $dbh = connectDB();
    $req = $dbh->query("SELECT id_vintage, qr_code, name, year from vintage inner join wine on fk_wine = id_wine order by id_vintage DESC limit 1;");
    $reqArray = $req->fetch();
 
    return $reqArray;    
}

function selectTypeWine()
{
    $dbh = connectDB();
    $req = $dbh->query("SELECT id_typeWine, typeWine FROM typeWine;");
 
    return $req; 
}
