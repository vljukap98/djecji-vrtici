<?php
    include_once("vanjske_biblioteke/sesija.class.php");
    include("vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
    $now = date("Y-m-d");
    $baza = new Baza();

    $baza->spojiDB();

    if ($baza->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dječji vrtići</title>
        <meta charset="UTF-8">
        <meta name="author" content="LJ">

        <link href="css/stil.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Architects+Daughter&display=swap" rel="stylesheet">

    </head>
    <body style="background-image: url(slike/index-slika.jpg)">
        <header>
            <h1><a href="index.php">Dječji vrtići</a></h1>
            <?php
                $putanja = dirname($_SERVER['REQUEST_URI']);
                include './navigacija.php';
            ?>
        </header>
        <section>
            <form novalidate method='GET' name='dnevnik_filter' action='dnevnik.php'>
                <label>Pretražite po datumu:</label><br>
                <input id='filter' name='filter' type='text'/>
                <input name='button_filter' type='submit' value='Filtriraj' style='font-family: Amatic SC, cursive;'/><br>
            </form>
            <?php
                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }

                if (isset($_GET["filter"])) {
                    $now = date("Y-m-d H:i:s");
                    $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                    $rs = $baza->selectDB($sql);
                    $vrijeme = $_GET["filter"];
                    $sql = "select k.OIB_korisnik, tp.naziv_promjene, d.vrijeme from korisnik k, tip_promjene tp, dnevnik d where k.OIB_korisnik = d.OIB_korisnik and d.tip_id = tp.tip_promjene_id and d.vrijeme  LIKE  '%{$vrijeme}%' order by d.vrijeme desc LIMIT $startrow, 7";
                } 
                else {
                    $sql = "select k.OIB_korisnik, tp.naziv_promjene, d.vrijeme from korisnik k, tip_promjene tp, dnevnik d where k.OIB_korisnik = d.OIB_korisnik and d.tip_id = tp.tip_promjene_id order by d.vrijeme desc LIMIT $startrow, 7";
                }

                $rs = $baza->selectDB($sql);

                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }
                
                echo "<table><tr><th>Šifra korisnika</th><th>Tip promjene</th><th>Vrijeme promjene</th></tr>\n";

                while (list($oib, $tip, $vrijeme) = $rs->fetch_array()) {
                    echo "<tr>
                    <td>$oib</td>
                    <td>$tip</td>
                    <td>$vrijeme</td>
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
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>