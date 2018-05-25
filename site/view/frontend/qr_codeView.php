<?php $title = 'Vue qr_codeView'; ?>

<?php ob_start(); ?>

<?php

foreach($ArrayQRCodes as $ArrayQRCode)
{
    echo "
    <table style='float: left; border: 1px solid black; margin: 10px;'>
        <tr>
            <td>
                <img src='qr_code/".$ArrayQRCode['qr_code']."-".$ArrayQRCode['name']."-".$ArrayQRCode['year'].".png' width='150px' height='150px'>
                <p>".$ArrayQRCode['qr_code']."-".$ArrayQRCode['name']."-".$ArrayQRCode['year']."</p>
                <a href='index.php?qr_code=".$ArrayQRCode['qr_code']."'><button>Imprimer</button></a>   
            </td>
        </tr>
    </table>
    ";
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
