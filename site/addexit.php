<?php
    require_once('fonction.php');
    connectDB();   
?>
<script>
    function showUser(str) {
        if (str=="") 
        {
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest) 
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else 
        { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() 
        {
            if (this.readyState==4 && this.status==200) 
            {
                document.getElementById("txtHint").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("POST","getuser.php?q="+str,true);
        xmlhttp.send();
    }
</script>

<select name="users" onchange="showUser(this.value)">
<option value="">Select a person:</option>
<option value="1">Peter Griffin</option>
<option value="2">Lois Griffin</option>
<option value="3">Joseph Swanson</option>
<option value="4">Glenn Quagmire</option>
</select>

<div id="txtHint"><b>Person info will be listed here.</b></div>

<?php    
    echo "
    <form method='post'>
        <div>
            <span style='border:1px solid black;padding: 5px;'>Nom du vin</span><br><br>
        
            <SELECT name='wine' size='1' style='padding-right: 60px'>";
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
            <span style='border:1px solid black;padding: 5px;'>Année</span><br><br>


        </div>
    </form>";
?>