<?php $title = 'Etat du stock'; ?>

<?php ob_start(); ?>

<form method='post'>
        <div class='text-center'>
                Au <input type='date' name='date' value=''>
                <button name='search'>Rechercher</button>
        </div>
</form>

<table>

        <?php
                foreach($ArrayWines as $ArrayWine)
                {
                        echo"
                        <tr>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 50px; padding-left: 30px;'>
                                        <b>Nom du vin</b> 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['name']."
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 50px; padding-left: 30px;'>
                                        <b>Type de vin</b> 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['typeWine']." 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 50px; padding-left: 30px;'>
                                        <b>Année</b> 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['year']."
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 50px; padding-left: 30px;'>
                                        <b>Quantité</b> 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>";
                                        if($ArrayWine['quantity'] > 1)
                                        {
                                                echo "".$ArrayWine['quantity']." bouteilles";
                                        }
                                        else
                                        {
                                                echo "".$ArrayWine['quantity']." bouteille";
                                        }
                                echo"
                                </td>
                        </tr>";
                }
        ?>

</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
