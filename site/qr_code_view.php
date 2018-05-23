<style>
@media print {
    #tohide {
        display :  none;
    }
    #tohide2 {
        display :  none;
    }
}
</style>
<?php
    require_once('fonction.php');
    connectDB();
    extract($_GET);

    $query = "SELECT id_vintage, qr_code, name, year from vintage inner join wine on fk_wine = id_wine where qr_code = $qr_code order by id_vintage;";
    $lastVintages = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    while($lastVintage = $lastVintages->fetch()) //fetch = aller chercher
    {
        extract($lastVintage); // $id_vintage, $qr_code, $name, $year
        echo "<table style='float: left; border: 1px solid black; margin: 30px;'>
                <tr>
                    <td>
                        <img src='qr_code/$qr_code-$name-$year.png'>
                        <p id='tohide'>$qr_code-$name-$year.png</p>
                        <button id='tohide2' onclick='print()'>Imprimer</button>
                    </td>
                </tr>
              </table>";
    }
?>