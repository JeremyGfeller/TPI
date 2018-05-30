<?php $title = 'Vue stockView'; ?>

<?php ob_start(); ?>

<form method='post'>
        Au <input type='date' name='date' value=''>
        <button name='search'>Rechercher</button>
</form>

<table>

        <?php
                foreach($ArrayWines as $ArrayWine)
                {
                        echo"
                        <tr>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px;'>
                                        <b>Nom du vin</b> 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['name']."
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px;'>
                                        Type de vin 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['typeWine']." 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px;'>
                                        Année 
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px; padding-left: 10px;'>
                                        ".$ArrayWine['year']."
                                </td>
                                <td style='border: 1px solid black; padding: 10px; padding-right: 10px;'>
                                        Quantité 
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
