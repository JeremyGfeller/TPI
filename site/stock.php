<?php
    require_once('fonction.php');
    connectDB();   

    /* Search in the base the data for an article */
    $query = "select id_vintage, id_wine, name, provider, year, qr_code, quantity, price, date 
                from vintage 
                inner join wine on fk_wine = id_wine;";
                
    $wines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

    /* Save the data in a array */
    $allWines = $wines->fetchAll(); //fetch = aller chercher
    echo json_encode($allWines);    
?>