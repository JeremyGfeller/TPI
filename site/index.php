<?php
require_once('controller/frontend.php');
extract($_POST);

try
{
    if(isset($_POST['add']))
    {
        if(isset($_POST['wineName']) && isset($_POST['year']) && isset($_POST['provider']) && isset($_POST['typeWine']) && isset($_POST['price']) && isset($_POST['quantity']))
        {
            addWine($wineName, $year, $provider, $typeWine, $price, $quantity);
        }
    }
    else
    {
        showAdd();
    }
}
catch(Exception $e)
{
    echo 'Erreur: ' . $e->getMessae();
}