<?php
    require_once('fonction.php');
    connectDB();   

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
?>