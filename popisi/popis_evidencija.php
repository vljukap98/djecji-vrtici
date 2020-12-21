<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
    $baza = new Baza();
    $baza->spojiDB();
    if(isset($_GET['povecaj'])) {
        $vrijednosti = explode(";", $_GET['povecaj']);
        $oib = $vrijednosti[0];
        $evidencija_id = $vrijednosti[1];

        $sql = "update evidentirano set broj_dolazaka = broj_dolazaka+1 where OIB_dijete = $oib and evidencija_id = $evidencija_id";
        $rs = $baza->selectDB($sql);
        if ($baza->pogreskaDB()) {
            echo "Problem kod upita na bazu podataka!";
            exit;
        }
        $now = date("Y-m-d H:i:s");
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 4)";
        $rs = $baza->selectDB($sql);
    }
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
                if($uloga === "3"){
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                    
                    $sql = "select d.ime, e.broj_dolazaka, ev.mjesec from dijete d, korisnik k, evidentirano e, evidencija ev where k.OIB_korisnik = d.roditelj_OIB and d.OIB_dijete = e.OIB_dijete and e.evidencija_id = ev.evidencija_id and k.OIB_korisnik = $korisnik_id LIMIT $startrow, 7";

                    $rs = $baza->selectDB($sql);

                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Ime djeteta</th><th>Broj dolazaka</th><th>Mjesec</th></tr>\n";

                    while (list($ime, $dolasci, $mjesec,) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$ime</td>
                        <td>$dolasci</td>
                        <td>$mjesec</td>
                        </tr>";
                    }
                    echo "</table>\n";

                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;

                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";

                    $rs->close();
                    $baza->zatvoriDB();
                } elseif($uloga === '2') {
                    echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_evidenciju.php'>Kreiraj evidenciju</a>";
                    
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                        
                    $sql = "select ev.evidencija_id, d.OIB_dijete, e.mjesec, d.OIB_dijete, d.ime, d.prezime, ev.broj_dolazaka from dijete d, evidencija e, evidentirano ev where e.evidencija_id = ev.evidencija_id and ev.OIB_dijete = d.OIB_dijete and e.OIB_korisnik_mod = '$korisnik_id' LIMIT $startrow, 7";
        
                    $rs = $baza->selectDB($sql);
        
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Mjesec</th><th>Dijete</th><th>Broj dolazaka</th></tr>\n";
        
                    while (list($ev_id, $oib, $mjesec, $oib, $ime, $prezime, $dolasci) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$mjesec</td>
                        <td>$oib $ime $prezime</td>
                        <td>$dolasci</td>
                        <td><a style='text-decoration: none; color: #30323d;' href='popis_evidencija.php?povecaj=$oib;$ev_id'>Zapiši dolazak</a>";
                    }
                    echo "</table>\n";
        
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;
        
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
        
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                } elseif($uloga === "1"){
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                    
                    $sql = "select d.OIB_dijete, d.ime, e.broj_dolazaka, ev.mjesec from dijete d, korisnik k, evidentirano e, evidencija ev where k.OIB_korisnik = d.roditelj_OIB and d.OIB_dijete = e.OIB_dijete and e.evidencija_id = ev.evidencija_id LIMIT $startrow, 7";

                    $rs = $baza->selectDB($sql);

                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>OIB djeteta</th><th>Ime djeteta</th><th>Broj dolazaka</th><th>Mjesec</th></tr>\n";

                    while (list($oib, $ime, $dolasci, $mjesec,) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$oib</td>
                        <td>$ime</td>
                        <td>$dolasci</td>
                        <td>$mjesec</td>
                        </tr>";
                    }
                    echo "</table>\n";

                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;

                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";

                    $rs->close();
                    $baza->zatvoriDB();
                }
            ?>
        </section>
    </body>
    <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
    </footer>
</html>