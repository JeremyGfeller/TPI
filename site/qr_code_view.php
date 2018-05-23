<script>
    function print()
    {
        //Get the print button and put it into a variable
        var printParagraph = document.getElementById("tohide");
        var printButton = document.getElementById("tohide2");
        //Set the print button visibility to 'hidden' 
        printParagraph.style.visibility = 'hidden';
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print();
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printParagraph.style.visibility = 'visible';
        printButton.style.visibility = 'visible';
    }
</script>
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