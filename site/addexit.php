<?php
    require_once('fonction.php');
    connectDB();
    //echo "POST :";  print_r($_POST); echo "<br>";   

    if(isset($_POST['in']))
    {
        $id_wine = $_POST['listYear'];
        $quantity = $_POST['quantity'];
        
        $query = "INSERT INTO movement (fk_users, fk_vintage, movement_in) VALUES ('1', '$id_wine', '$quantity');";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);

        $query = "UPDATE vintage SET quantity = quantity + $quantity WHERE id_vintage = $id_wine;";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }

    if(isset($_POST['out']))
    {
        $id_wine = $_POST['id_wine'];
        $quantity = $_POST['quantity'];
        
        $query = "INSERT INTO movement (fk_users, fk_vintage, movement_out) VALUES ('1', '$id_wine', '$quantity');";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    
        $query = "UPDATE vintage SET quantity = quantity - $quantity WHERE id_vintage = $id_wine;";
        $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    }
?>
<script>
    function yearWine(str) {
        if (str=="") 
        {
            document.getElementById("year").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest) 
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } 
        else 
        { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() 
        {
            if (this.readyState==4 && this.status==200) 
            {
                document.getElementById("year").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","searchWine.php?id_wine="+str,true);
        xmlhttp.send();
    }
</script>

<?php 
    echo "
    <form method='post'>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Nom du vin</span><br>
            <SELECT name='id_wine' size='1' style='padding-right: 60px; margin: 10px;' onchange='yearWine(this.value)'>
                <option value='' selected>Selectionnez un vin</option>";
                $query = "SELECT id_wine, name FROM wine;";
                $wines = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
                            
                /* Show the article in the table */
                while($wine = $wines->fetch()) //fetch = aller chercher
                {
                    extract($wine); // $id_wine, $name
                    echo "<option value='$id_wine'>$name</option>";
                }
            echo "
            </SELECT>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Année</span><br>
            <div id='year' style='margin: 10px;'></div>
        </div>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Nombre de bouteilles</span><br>
            <input type='text' name='quantity' required style='margin: 10px;'/>
        </div>
        <div>
            <span style='border:1px solid black; padding: 5px;'>Date</span><br>
            <div id='date' style='margin: 10px;'>"; echo date('d-m-Y'); echo "</div>
        </div>
        <div>
            <button name='in'>Entrée</button>
            <button name='out'>Sortie</button>
        </div>
    </form>";
?>