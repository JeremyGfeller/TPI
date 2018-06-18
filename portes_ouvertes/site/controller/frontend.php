<?php
require('model/frontend.php');
require('phpqrcode/qrlib.php');
extract($_POST);

function addWine($wineName, $year, $provider, $typeWine, $price, $quantity)
{
    $selectWine = newWine($wineName);

    // Check si le vin est déjà éxistant ou pas
    if($selectWine == NULL)
    {
        insertWine($typeWine, $wineName, $provider);
    }

    $selectVintage = selectVintage($wineName, $year);

    // Check si le millésime est déjà éxistant ou pas
    if($selectVintage == NULL)
    {
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
    $selectTypeWines = selectTypeWine();
    
    $ArrayTypeWines = array();
    foreach($selectTypeWines as $selectTypeWine) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayTypeWines, array('id_typeWine' => $selectTypeWine['id_typeWine'] ,'typeWine' => $selectTypeWine['typeWine']));
    }
    
    require('view/frontend/addView.php');
}

function showStock()
{
    $quantityNoDates = quantityNoDate();
     
    $ArrayWines = array();
    foreach($quantityNoDates as $quantityNoDate) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        $res = array('name' => $quantityNoDate['name'] , 'typeWine' => $quantityNoDate['typeWine'], 'year' => $quantityNoDate['year']);
        
        // calcule de la quantité
        $lastInventory = lastInventory($quantityNoDate['id_vintage']);
        extract($lastInventory); // $date, $nb_bottles

        $sumMovements = sumMovements($quantityNoDate['id_vintage'], $lastInventory['date']);
        extract($sumMovements); // $quantity

        $nb_bottle = $sumMovements['quantity'] + $lastInventory['nb_bottles'];

        $res['quantity'] = $nb_bottle;
        array_push($ArrayWines, $res);
    }

    require('view/frontend/stockView.php');
}

function showStockWithDate($dateNow)
{
    $quantityNoDates = quantityNoDate();
     
    $ArrayWines = array();
    foreach($quantityNoDates as $quantityNoDate) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        $res = array('name' => $quantityNoDate['name'] , 'typeWine' => $quantityNoDate['typeWine'], 'year' => $quantityNoDate['year']);
        
        // calcule de la quantité
        $lastInventoryWithDate = lastInventoryWithDate($quantityNoDate['id_vintage'], $dateNow);
        extract($lastInventoryWithDate); // $date, $nb_bottles

        if($lastInventoryWithDate != null)
        {
            $sumMovementsWithDate = sumMovementsWithDate($quantityNoDate['id_vintage'], $date, $dateNow);
            extract($sumMovementsWithDate); // $quantity

            $nb_bottle = $quantity + $nb_bottles;
    
            $res['quantity'] = $nb_bottle;
            array_push($ArrayWines, $res);
        }
    }

    require('view/frontend/stockView.php');
}

function in($listYear, $quantity)
{
    wineIn($listYear, $quantity);
    showAddexit();
}

function out($listYear, $quantity)
{
    wineOut($listYear, $quantity);
    showAddexit();
}

function showAddexit()
{
    $selectWines = selectWine();

    $ArrayWines = array();
    foreach($selectWines as $selectWine) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayWines, array('id_wine' => $selectWine['id_wine'], 'name' => $selectWine['name']));
    }

    require('view/frontend/addexitView.php');
}

function showQR()
{
    $selectQRCodes = selectQRCode();

    $ArrayQRCodes = array();
    foreach($selectQRCodes as $selectQRCode) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayQRCodes, array('id_vintage' => $selectQRCode['id_vintage'] , 'qr_code' => $selectQRCode['qr_code'], 'name' => $selectQRCode['name'], 'year' => $selectQRCode['year']));
    }
    
    require('view/frontend/qr_codeView.php');
}

function showPrint($qr_code)
{
    $printQRs = printQR($qr_code);

    $ArrayPrintQRCodes = array();
    foreach($printQRs as $printQR) //Je lis dans le resultat de la requête pour chaque entrée reçue
    {
        array_push($ArrayPrintQRCodes, array('id_vintage' => $printQR['id_vintage'] , 'qr_code' => $printQR['qr_code'], 'name' => $printQR['name'], 'year' => $printQR['year']));
    }
    
    require('view/frontend/qr_codePrintView.php');
}

function showUser()
{
    require('view/frontend/userView.php');
}