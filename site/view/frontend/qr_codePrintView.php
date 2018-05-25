<style>
    @media print {
    #tohide {
        display :  none;
    }
    #tohide2 {
        display :  none;
    }
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
</style>

<?php $title = 'Vue qr_codePrintView'; ?>

<?php ob_start(); ?>

<?php

foreach($ArrayPrintQRCodes as $ArrayPrintQRCode)
{
    echo "
    <table style='float: left; border: 1px solid black; margin: 10px;'>
        <tr>
            <td>
                <img src='qr_code/".$ArrayPrintQRCode['qr_code']."-".$ArrayPrintQRCode['name']."-".$ArrayPrintQRCode['year'].".png'>
                <p id='tohide'>".$ArrayPrintQRCode['qr_code']."-".$ArrayPrintQRCode['name']."-".$ArrayPrintQRCode['year']."</p>
                <a id='tohide2' onclick='print()'><button>Imprimer</button></a>   
            </td>
        </tr>
    </table>
    ";
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
