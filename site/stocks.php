<?php
    require_once('fonction.php');
    connectDB(); 
    extract($_POST);
    //echo "POST :";  print_r($_POST); echo "<br><br>"; 
?>
<?php 
    echo "
    <form method='post'>
        Au <input type='date' name='date' value=''>
        <button name='search'>Rechercher</button>
    </form>";

    if(isset($_POST['search']))
    {
        echo "
        <table style='border: 1px solid black'>";

            $query = "SELECT name, typeWine, year, quantity, date FROM wine
            INNER JOIN vintage on id_wine = fk_wine
            INNER JOIN typeWine on fk_typeWine = id_typeWine
            WHERE date LIKE '$date%';";

            $stocks = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

            while($stock = $stocks->fetch())
            {
                extract($stock); // $name, $typeWine, $year, $quantity
                echo"
                <tr>
                    <td style='border: 1px solid black'>
                        Nom du vin 
                    </td>
                    <td style='border: 1px solid black'>
                        $name
                    </td>
                    <td style='border: 1px solid black'>
                        Type de vin 
                    </td>
                    <td style='border: 1px solid black'>
                        $typeWine 
                    </td>
                    <td style='border: 1px solid black'>
                        Année 
                    </td>
                    <td style='border: 1px solid black'>
                        $year 
                    </td>
                    <td style='border: 1px solid black'>
                        Quantité 
                    </td>
                    <td style='border: 1px solid black'>";
                        if($quantity > 1)
                        {
                            echo "$quantity bouteilles";
                        }
                        else
                        {
                            echo "$quantity bouteille"; 
                        }
                    echo"
                    </td>
                </tr>";
            }
        echo "
        </table>";
    }
    else
    {
        echo "
        <table style='border: 1px solid black'>";

            $query = "SELECT name, typeWine, year, quantity FROM wine
                        INNER JOIN vintage on id_wine = fk_wine
                        INNER JOIN typeWine on fk_typeWine = id_typeWine;";

            $stocks = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

            while($stock = $stocks->fetch())
            {
                extract($stock); // $name, $typeWine, $year, $quantity
                echo"
                <tr>
                    <td style='border: 1px solid black'>
                        Nom du vin 
                    </td>
                    <td style='border: 1px solid black'>
                        $name
                    </td>
                    <td style='border: 1px solid black'>
                        Type de vin 
                    </td>
                    <td style='border: 1px solid black'>
                        $typeWine 
                    </td>
                    <td style='border: 1px solid black'>
                        Année 
                    </td>
                    <td style='border: 1px solid black'>
                        $year 
                    </td>
                    <td style='border: 1px solid black'>
                        Quantité 
                    </td>
                    <td style='border: 1px solid black'>";
                        if($quantity > 1)
                        {
                            echo "$quantity bouteilles";
                        }
                        else
                        {
                            echo "$quantity bouteille"; 
                        }
                    echo"
                    </td>
                </tr>";
            }
        echo "
        </table>";
    }
    
?>