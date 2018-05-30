<?php $title = 'Vue stockView'; ?>

<?php ob_start(); ?>

<form method='post'>
        Au <input type='date' name='date' value=''>
        <button name='search'>Rechercher</button>
</form>

<table style='border: 1px solid black'>

        <?php
                foreach($ArrayWines as $ArrayWine)
                {
                        echo"
                        <tr>
                                <td style='border: 1px solid black'>
                                        Nom du vin 
                                </td>
                                <td style='border: 1px solid black'>
                                        ".$ArrayWine['name']."
                                </td>
                                <td style='border: 1px solid black'>
                                        Type de vin 
                                </td>
                                <td style='border: 1px solid black'>
                                        ".$ArrayWine['typeWine']." 
                                </td>
                                <td style='border: 1px solid black'>
                                        Année 
                                </td>
                                <td style='border: 1px solid black'>
                                        ".$ArrayWine['year']."
                                </td>
                                <td style='border: 1px solid black'>
                                        Quantité 
                                </td>
                                <td style='border: 1px solid black'>";
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
