<?php $title = 'Ajouter un nouveau vin'; ?>

<?php ob_start(); ?>
    
    <style>
        .espacement
        {
            margin-bottom: 30px;
        }
    </style>

    <form method='post'>
        <div class='col-lg-7 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Nom du vin</span><br>
            <input type='text' name='wineName' style='margin-top: 10px'/>
        </div>
        <div class='col-lg-5 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Année</span><br>
            <input type='number' min='1' name='year' style='margin-top: 10px'/>
        </div>
        <div class='col-lg-7 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Type de vin</span><br>
            <select name='typeWine' style='margin-top: 10px'>
                
                <?php //Le tableau est déjà connu par le programe car tu l'as crée dans le controller. Comme tu appelle cette page, tu gardes toute les variables déjà connues
                    foreach($ArrayTypeWines as $ArrayTypeWine) //Je lis dans le tableau cette fois-ci
                    {
                        echo "<option value=".$ArrayTypeWine['id_typeWine'].">".$ArrayTypeWine['typeWine']."</option>"; // echo "<option value=".ArrayTypeWine['id_typeWine'].">".ArrayTypeWine['typeWine']."</option>";
                    }
                ?>
                
            </select>
        </div>
        <div class='col-lg-5 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Nombre de bouteilles</span><br>
            <input type='number' min='1' name='quantity' style='margin-top: 10px;' required/>
        </div>
        <div class='col-lg-7 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Fournisseurs</span><br>
            <input type='text' name='provider' style='margin-top: 10px;' required/>
        </div>
        <div class='col-lg-5 espacement'>
            <span style='border:1px solid black;padding: 5px;'>Prix</span><br>
            <input type='number' min='1' name='price' style='margin-top: 10px;' required/>
        </div>
        <div class='col-lg-12' style='padding-left: 350px;'>
            <button name='add'>Entrée</button>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
