<?php $title = 'Vue addView'; ?>

<?php ob_start(); ?>
    
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
            <select name='typeWine' style='margin: 10px'>
                
                <?php //Le tableau est déjà connu par le programe car tu l'as crée dans le controller. Comme tu appelle cette page, tu gardes toute les variables déjà connues
                    foreach($ArrayTypeWines as $ArrayTypeWine) //Je lis dans le tableau cette fois-ci
                    {
                        echo "<option value=".$ArrayTypeWine['id_typeWine'].">".$ArrayTypeWine['typeWine']."</option>"; // echo "<option value=".ArrayTypeWine['id_typeWine'].">".ArrayTypeWine['typeWine']."</option>";
                    }
                ?>
                
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
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
