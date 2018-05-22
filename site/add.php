<?php
    require_once('fonction.php');
    connectDB();
    extract($_POST);
    echo "POST :";  print_r($_POST); echo "<br><br>";   

    if(isset($_POST['add']))
    {
        $nameWine = "SELECT id_wine, name FROM wine WHERE name = '$wineName';";
        $nameWines = $dbh->query($nameWine) or die ("SQL Error in:<br> $nameWine <br>Error message:".$dbh->errorInfo()[2]);

        // Check si le vin est déjà éxistant ou pas
        if($nameWines->rowCount()<= 0)
        {
            $query = "INSERT INTO wine (fk_typeWine, name, provider) VALUES ('$typeWine', '$wineName', '$provider');";
            $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
        }

        $query = "INSERT INTO vintage (fk_wine, year, quantity, price) VALUES ((SELECT id_wine from wine WHERE name = '$wineName'), '$year', '$quantity', '$price');";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
        $query = "UPDATE vintage SET qr_code = (SELECT id_vintage order by id_vintage DESC limit 1);";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }
?>
<?php 
    echo "
    <form method='post'>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Nom du vin</span><br>
            <input type='text' name='wineName' style='margin: 10px'/>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Année</span><br>
            <input type='text' name='year' style='margin: 10px'/>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Type de vin</span><br>
            <select name='typeWine' style='margin: 10px'>";
            $query = "SELECT id_typeWine, typeWine FROM typeWine;";
            $typeWines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
                        
            /* Show the article in the table */
            while($typeWine = $typeWines->fetch()) //fetch = aller chercher
            {
                extract($typeWine); // $id_wine, $name
                echo "<option value='$id_typeWine'>$typeWine</option>";
            }
            echo "
            </select>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Nombre de bouteilles</span><br>
            <input type='text' name='quantity' style='margin: 10px;' required/>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Fournisseurs</span><br>
            <input type='text' name='provider' style='margin: 10px;' required/>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Prix</span><br>
            <input type='text' name='price' style='margin: 10px;' required/>
        </div>
        <div>
            <button name='add'>Entrée</button>
        </div>
    </form>";
?>