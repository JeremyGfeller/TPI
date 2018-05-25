<?php
require('model/frontend.php');
require('phpqrcode/qrlib.php');

//echo "POST: "; print_r($_POST); echo "<br><br>";

function addWine($wineName, $year, $provider, $typeWine, $price, $quantity)
{
    $newWine = newWine($wineName);

    // Check si le vin est déjà éxistant ou pas
    if($newWine == NULL)
    {
        extract($newWine); //$id_wine, $name
        insertWine($typeWine, $wineName, $provider);
    }

    $selectVintage = selectVintage($wineName, $year);

    // Check si le millésime est déjà éxistant ou pas
    if($selectVintage == NULL)
    {
        extract($selectVintage); //$id_wine, $name
        insertVintage($wineName, $year, $price, $quantity);
    }

    $updateQRCode = updateQRCode();

    if($updateQRCode != NULL)
    {
        extract($updateQRCode); // $id_vintage, $qr_code, $name, $year
        QRcode::png($qr_code, 'qr_code/'.$qr_code.'-'.$name.'-'.$year.'.png', QR_ECLEVEL_L, 20); // creates file
    }
    showAdd();
}

function showAdd()
{
    
    //############################ Gère les types de vin ###################################
    $selectTypeWines = selectTypeWine();
    
    $ArrayTypeWines = array();
    foreach($selectTypeWines as $selectTypeWine) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayTypeWines, array('id_typeWine' => $selectTypeWine['id_typeWine'] ,'typeWine' => $selectTypeWine['typeWine']));
    }
    
    require('view/frontend/addView.php');
}

function showPrint()
{
    $selectQRCodes = selectQRCode();

    $ArrayQRCodes = array();
    foreach($selectQRCodes as $selectQRCode) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayQRCodes, array('id_vintage' => $selectQRCode['id_vintage'] , 'qr_code' => $selectQRCode['qr_code'], 'name' => $selectQRCode['name'], 'year' => $selectQRCode['year']));
    }
    
    require('view/frontend/qr_codeView.php');
}