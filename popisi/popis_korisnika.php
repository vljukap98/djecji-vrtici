<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
    $baza = new Baza();
    $baza->spojiDB();

    if(isset($_GET['blokiraj'])) {
        $blokiraj_oib = $_GET['blokiraj'];
        $sql = "update korisnik set aktiviran=false where OIB_korisnik = $blokiraj_oib";
        $rs = $baza->selectDB($sql);
        if ($baza->pogreskaDB()) {
            echo "Problem kod upita na bazu podataka!";
            exit;
        }
        $now = date("Y-m-d H:i:s");
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 4)";
        $rs = $baza->selectDB($sql);
    }

    if(isset($_GET['aktiviraj'])) {
        $aktiviraj_oib = $_GET['aktiviraj'];
        $sql = "update korisnik set aktiviran=true where OIB_korisnik = $aktiviraj_oib";
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

        <link href="css/stil.css" rel="stylesheet" type="text/css"/>
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
            <a style='text-decoration: none; color: #30323d;' href="../kreiranja/kreiraj_korisnika.php">Dodaj novog korisnika</a><br>
            <a style='text-decoration: none; color: #30323d;' href="../kreiranja/kreiraj_moderatora.php">Kreiraj novog moderatora</a><br><br>
            <form novalidate method='GET' name='form_filter' action='popis_korisnika.php'>
                <label>Pretražite korisnika po OIB-u:</label><br>
                <input id='filter' name='filter' type='text'/>
                <input name='button_filter' type='submit' value='Filtriraj' style='font-family: Amatic SC, cursive;'/><br>
            </form>
            <?php
                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }
                if(isset($_GET["filter"])) {
                    $now = date("Y-m-d H:i:s");
                    $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                    $rs = $baza->selectDB($sql);
                    $filter = $_GET["filter"];
                    $sql = "select OIB_korisnik, ime, prezime, korisnicko_ime, lozinka, email, vrijeme_registracije, aktiviran, uloga_id from korisnik where OIB_korisnik = '$filter' order by vrijeme_registracije desc limit $startrow, 7";
                } 
                if (isset($_GET["sort_datum"])) {
                    $now = date("Y-m-d H:i:s");
                    $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                    $rs = $baza->selectDB($sql);
                    $sql = "select OIB_korisnik, ime, prezime, korisnicko_ime, lozinka, email, vrijeme_registracije, aktiviran, uloga_id from korisnik order by vrijeme_registracije desc limit $startrow, 7";
                } if(!isset($_GET["filter"]) && !isset($_GET["sort_datum"])) {
                    $sql = "select OIB_korisnik, ime, prezime, korisnicko_ime, lozinka, email, vrijeme_registracije, aktiviran, uloga_id from korisnik limit $startrow, 7";
                }
                $rs = $baza->selectDB($sql);

                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }

                echo "<table><tr><th>OIB</th><th>Ime i Prezime</th><th>Korisnicko ime</th><th>Lozinka</th><th>E-mail</th><th><a style='text-decoration: none; color: #30323d;' href='popis_korisnika.php?sort_datum=true'>Registrirano na</a></th><th>Račun aktiviran</th><th>Uloga korisnika</th></tr>\n";

                while (list($oib, $ime, $prezime, $kime, $lozinka, $email, $datum_reg, $aktiviran, $uloga) = $rs->fetch_array()) {
                    if($uloga != 1) {
                        echo "<tr>
                        <td>$oib</td>
                        <td>$ime $prezime</td>
                        <td>$kime</td>
                        <td>$lozinka</td>
                        <td><a style='color: #30323d;' href=mailto:$email>$email</a></td>
                        <td>$datum_reg</td>
                        <td>";
                        if($aktiviran) {
                            echo "<a style='text-decoration: none; color: #30323d;' href='popis_korisnika.php?blokiraj=$oib'>Da</a>";
                        } else {
                            echo "<a style='text-decoration: none; color: #30323d;' href='popis_korisnika.php?aktiviraj=$oib'>Ne</a>";
                        }
                        echo "</td>
                        <td>";
                         if($uloga === "2") {
                            echo "Moderator";
                        } elseif($uloga === "3") {
                            echo "Registrirani";
                        } elseif($uloga === "4") {
                            echo "Neregistrirani";
                        }
                        
                        echo "</td>
    
                        </tr>\n";
                        
                    }
                }
                echo "</table>\n";

                echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                $prethodna = $startrow - 7;

                if ($prethodna >= 0)
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";

                echo "</div>";
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