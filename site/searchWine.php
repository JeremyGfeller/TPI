<?php
    require_once('fonction.php');
    connectDB();   
    extract($_GET);

    //echo "GET :";  print_r($_GET); echo "<br>";

    $query = "SELECT name, year FROM wine 
                INNER JOIN vintage ON id_wine = fk_wine 
                WHERE id_wine = $id_wine;";
    $wines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);  

    /* Save the data in a array */
    while($wine = $wines->fetch()) //fetch = aller chercher
    {
        extract($wine); // $wine, $year
        echo $year;
    }
?>
