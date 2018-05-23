<?php
    require_once('fonction.php');
    connectDB();

    $query = "SELECT id_vintage, qr_code, name, year from vintage inner join wine on fk_wine = id_wine order by id_vintage;";
    $lastVintages = $dbh->query($query) or die ("SQL Error in:<br> $query <br>Error message:".$dbh->errorInfo()[2]);
    while($lastVintage = $lastVintages->fetch()) //fetch = aller chercher
    {
        extract($lastVintage); // $id_vintage, $qr_code, $name, $year
        echo "<table style='float: left; border: 1px solid black; margin: 10px;'>
                <tr>
                    <td>
                        <img src='qr_code/$qr_code-$name-$year.png' width='150px' height='150px'>
                        <p>$qr_code-$name-$year.png</p>
                        <a href='qr_code_view.php?qr_code=$qr_code'><button>Imprimer</button></a>
                    </td>
                </tr>
              </table>";
    }
?>