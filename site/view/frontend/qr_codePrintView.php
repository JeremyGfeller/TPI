<style>
    @media print 
    {
        #tohide 
        {
            display : none;
        }
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
    }
</style>

<?php $title = 'Impression du QR Code'; ?>

<?php ob_start(); ?>

<?php

foreach($ArrayPrintQRCodes as $ArrayPrintQRCode)
{
    echo "
    <table style='float: left; border: 1px solid black; margin: 10px;'>
        <tr>
            <td align='center'>
                <img src='qr_code/".$ArrayPrintQRCode['qr_code']."-".$ArrayPrintQRCode['name']."-".$ArrayPrintQRCode['year'].".png'>
                <p>".$ArrayPrintQRCode['name']." de ".$ArrayPrintQRCode['year']."</p>
                <a id='tohide' onclick='print()'><button>Imprimer</button></a>
            </td>
        </tr>
    </table>
    ";
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
