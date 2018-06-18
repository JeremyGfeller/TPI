<?php
require_once('controller/frontend.php');
extract($_POST);
extract($_GET);
error_log(print_r($_POST, 1));
error_log(print_r($_GET, 1));

try
{
    if(isset($add))
    {
        if(isset($wineName) && isset($year) && isset($provider) && isset($typeWine) && isset($price) && isset($quantity))
        {
            addWine($wineName, $year, $provider, $typeWine, $price, $quantity);
        }
    }
    elseif(isset($user))
    {
        showUser();
    }
    elseif(isset($search))
    {
        showStockWithDate($date);
    }
    elseif(isset($stocks))
    {        
        showStock();
    }
    elseif(isset($in))
    {
        in($listYear, $quantity);
    }
    elseif(isset($out))
    {
        out($listYear, $quantity);
    }
    elseif(isset($addexit))
    {
        showAddexit();
    }
    elseif(isset($qr_code))
    {
        showPrint($qr_code);
    }
    elseif(isset($addwine))
    {
        showAdd();
    }
    elseif(isset($qr))
    {
        showQR();
    }
    else
    {
        require('view/frontend/template.php');
    }
}
catch(Exception $e)
{
    echo 'Erreur: ' . $e->getMessage();
}