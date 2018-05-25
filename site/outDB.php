<?php
    require_once('fonction.php');
    connectDB();   

    /* Search in the base the data for an article */
    $query = "select id_typeWine, typeWine from typeWine;";        
    $typeWines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

    while ($typeWine = $typeWines->fetch()) {
        $arr[] = array(
            "id_typeWine" => $typeWine['id_typeWine'], 
            "typeWine" => $typeWine['typeWine']
        );
    }
    echo json_encode($arr);
?>