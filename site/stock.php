<?php
    require_once('fonction.php');
    connectDB();   

    //SELECT name, typeWine, year, id_vintage FROM wine INNER JOIN vintage on id_wine = fk_wine INNER JOIN typeWine on fk_typeWine = id_typeWine;

    $query = "SELECT id_wine, name, typeWine, year, id_vintage FROM wine INNER JOIN vintage on id_wine = fk_wine INNER JOIN typeWine on fk_typeWine = id_typeWine;";
    $allWines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
    $ArrayWines = array();
    foreach($allWines as $allWine)
    {
        extract($allWine); // $name, $typeWine, $year, $id_vintage
        $res = array('id_wine' => $id_wine, 'id_vintage' => $id_vintage, 'name' => $name, 'typeWine' => $typeWine, 'year' => $year);

        $query = "SELECT date, fk_vintage, nb_bottles from movement where fk_vintage = $id_vintage and movement_type = 0 order by date DESC Limit 1";
        $lastInventorys = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
        foreach($lastInventorys as $lastInventory)
        {
            extract($lastInventory);

            $query = "SELECT sum(nb_bottles * movement_type) as quantity from movement where fk_vintage = $id_vintage and date > '$date'";
            $sumMovements = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

            foreach($sumMovements as $sumMovement)
            {
                extract($sumMovement);
                $nb_bottle = $quantity + $nb_bottles;
        
                $res['quantity'] = $nb_bottle;
                array_push($ArrayWines, $res);
            }
        }
    }

    echo json_encode($ArrayWines); 

    //SELECT date, fk_vintage, nb_bottles from movement where fk_vintage = $id_vintage and movement_type = 0 order by date DESC Limit 1;
    //SELECT sum(nb_bottles * movement_type) as quantity from movement where fk_vintage = $id_vintage and date > '$date'

    /*$quantityNoDates = quantityNoDate();
     
    $ArrayWines = array();
    foreach($quantityNoDates as $quantityNoDate) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        $res = array('name' => $quantityNoDate['name'] , 'typeWine' => $quantityNoDate['typeWine'], 'year' => $quantityNoDate['year']);
        
        // calcule de la quantité
        $lastInventory = lastInventory($quantityNoDate['id_vintage']);
        extract($lastInventory); // $date, $nb_bottles

        $sumMovements = sumMovements($quantityNoDate['id_vintage'], $lastInventory['date']);
        extract($sumMovements); // $quantity

        $nb_bottle = $sumMovements['quantity'] + $lastInventory['nb_bottles'];

        $res['quantity'] = $nb_bottle;
        array_push($ArrayWines, $res);
    }*/

    /* Search in the base the data for an article */
    /*$query = "SELECT id_vintage, id_wine, name, provider, year, qr_code, ((SELECT sum(nb_bottles * movement_type) + (SELECT nb_bottles FROM movement
                WHERE movement_type = 0
                order by date DESC
                Limit 1) from movement)) as quantity, price, date from vintage inner join wine on fk_wine = id_wine;";
                
    $wines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);*/

    /* Save the data in a array */
    /*$allWines = $wines->fetchAll(); //fetch = aller chercher
    echo json_encode($allWines); */   
?>