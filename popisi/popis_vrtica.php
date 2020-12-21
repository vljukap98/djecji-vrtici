<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    if(isset($_SESSION['uloga'])){
        $uloga = $_SESSION['uloga'];
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['id'];
    }
    $baza = new Baza();
    $baza->spojiDB();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dječji vrtići</title>
        <meta charset="UTF-8">
        <meta name="author" content="LJ">

        <link href="../css/stil.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Architects+Daughter&display=swap" rel="stylesheet">
    </head>
    <body style="background-image: url(../slike/index-slika.jpg)">
        <header>
            <h1><a href="../index.php">Dječji vrtići</a></h1>
            <?php
                $putanja = dirname($_SERVER['REQUEST_URI'], 2);
                include '.././navigacija.php';
            ?>
        </header>
        <section>
            <?php
                if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "1"){
                    echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_vrtic.php'>Dodaj vrtić i dodijeli moderatora</a><br>";
                    echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/ocijeni_vrtic.php'>Ocijeni vrtić</a>";
                }
                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }
                $sql = "select dv.naziv_djecjeg_vrtica, dv.adresa, k.ime, k.prezime, k.email, dv.galerija from djecji_vrtic dv, korisnik k where k.OIB_korisnik = dv.OIB_korisnik_mod LIMIT $startrow, 7";

                $rs = $baza->selectDB($sql);

                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }
                
                echo "<table><tr><th>Ime</th><th>Adresa</th><th>Ravnatelj</th><th>Kontakt</th></tr>\n";

                while (list($naziv_vrtica, $adresa, $ime, $prezime, $kontakt, $putanja) = $rs->fetch_array()) {
                    echo "<tr>
                    <td>Dječji vrtić '$naziv_vrtica'</td>
                    <td>$adresa</td>
                    <td>$ime $prezime</td>
                    <td><a style='color: #30323d;' href=mailto:$kontakt>$kontakt</a></td>
                    <td><a style='color: #30323d;' href='../galerija.php?putanja=slike/$putanja'>Galerija</a></td>
                    </tr>\n";
                }
                echo "</table>\n";

                echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                $prethodna = $startrow - 7;

                if ($prethodna >= 0)
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";

                $rs->close();
                $baza->zatvoriDB();
            ?>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="../o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>