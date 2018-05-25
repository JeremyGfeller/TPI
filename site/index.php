<?php
require_once('controller/frontend.php');
extract($_POST);
extract($_GET);

try
{
    if(isset($_POST['add']))
    {
        if(isset($_POST['wineName']) && isset($_POST['year']) && isset($_POST['provider']) && isset($_POST['typeWine']) && isset($_POST['price']) && isset($_POST['quantity']))
        {
            addWine($wineName, $year, $provider, $typeWine, $price, $quantity);
        }
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
        require('view/frontend/home.php');
    }
}
catch(Exception $e)
{
    echo 'Erreur: ' . $e->getMessae();
}