<?php $title = 'Entrée sortie de bouteilles'; ?>

<?php ob_start(); ?>
    
    <style>
        .espacement
        {
            margin-bottom: 30px;
        }
    </style>

    <form method='post'>
        <div class='col-lg-7 espacement text-center'>
            <span style='border:1px solid black;padding: 5px;'>Nom du vin</span><br>
            <SELECT name='id_wine' size='1' style='padding-right: 60px; margin-top: 10px;' onchange='yearWine(this.value)'>
                <option value='' selected>Selectionnez un vin</option>
                <?php //Le tableau est déjà connu par le programe car tu l'as crée dans le controller. Comme tu appelle cette page, tu gardes toute les variables déjà connues
                    foreach($ArrayWines as $ArrayWine) //Je lis dans le tableau cette fois-ci
                    {
                        echo "<option value=".$ArrayWine['id_wine'].">".$ArrayWine['name']."</option>"; // echo "<option value=".ArrayTypeWine['id_typeWine'].">".ArrayTypeWine['typeWine']."</option>";
                    }
                ?>
            </SELECT>
        </div>
        <div class='col-lg-5 espacement text-center'>
            <span style='border:1px solid black;padding: 5px;'>Année</span><br>
            <div id='year' style='margin-top: 10px;'></div>
        </div>
        <div class='col-lg-7 espacement text-center'>
            <span style='border:1px solid black;padding: 5px;'>Nombre de bouteilles</span><br>
            <input type='number' min='1' name='quantity' required style='margin-top: 10px;'/>
        </div>
        <div class='col-lg-5 espacement text-center'>
            <span style='border:1px solid black; padding: 5px;'>Date</span><br>
            <div id='date' style='margin-top: 10px;'><?= date('d-m-Y'); ?></div>
        </div>
        <div class='col-lg-12 text-center'>
            <button style='padding: 5px; padding-right: 30px; padding-left: 30px;' name='in'>Entrée</button>
            <button style='padding: 5px; padding-right: 30px; padding-left: 30px;' name='out'>Sortie</button>
        </div>
    </form>

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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
