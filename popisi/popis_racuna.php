<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
    $baza = new Baza();
    $baza->spojiDB();


    if(isset($_GET['plati'])) {
        $racun_id = $_GET['plati'];
        $sql = "update racun set placen=true where racun_id = $racun_id";
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
                    
                    $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik and k.korisnicko_ime = '$korisnik' LIMIT $startrow, 7";

                    $baza->spojiDB();
                    $rs = $baza->selectDB($sql);

                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Br. računa</th><th>Datum dospijeća</th><th>Iznos</th><th>Plaćen</th></tr>\n";

                    while (list($br, $datum, $iznos, $placen) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$datum</td>
                        <td>$iznos kn</td>";
                            if($placen) {
                                echo"<td>Da</td>";
                            } else {
                                echo"<td>Ne</td>";
                                echo "<td><a style='text-decoration: none; color: #30323d;' href='popis_racuna.php?plati=$br'>Označi kao plaćen</a></td>";
                            }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";

                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;

                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";

                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                } elseif($uloga === '2') {
                    echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_racun.php'>Izdaj novi račun</a>";
                    
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                    if(isset($_GET['sort_datum'])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik and r.OIB_korisnik_mod = '$korisnik_id' order by r.mjesec LIMIT $startrow, 7";
                    }
                    if(isset($_GET['sort_placen'])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik and r.OIB_korisnik_mod = '$korisnik_id' order by r.placen desc LIMIT $startrow, 7";
                    }
                    if(!isset($_GET['sort_datum']) && !isset($_GET['sort_placen'])) {
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik and r.OIB_korisnik_mod = '$korisnik_id' LIMIT $startrow, 7";
                    }
                    $rs = $baza->selectDB($sql);
        
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Broj računa</th><th><a style='text-decoration: none; color: #30323d;' href='popis_racuna.php?sort_datum=true'>Mjesec</a></th><th>Iznos računa</th><th><a style='text-decoration: none; color: #30323d;' href='popis_racuna.php?sort_placen=true'>Račun plaćen</a></th><th>Kontakt platitelja</th></tr>\n";
        
                    while (list($br, $mjesec, $iznos, $placen, $kontakt) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$mjesec</td>
                        <td>$iznos kn</td>
                        <td>";
                        if($placen) {
                            echo "Da";
                        } else {
                            echo "Ne";
                        }
                        echo "</td>
                        <td><a style='color: #30323d;' href=mailto:$kontakt>$kontakt</a></td>
                        </tr>";
                    }
                    echo "</table>\n";
        
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;
        
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
        
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                } elseif($uloga === '1') {
                    
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                    if(isset($_GET['sort_datum'])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik order by r.mjesec LIMIT $startrow, 7";
                    }
                    if(isset($_GET['sort_placen'])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik order by r.placen desc LIMIT $startrow, 7";
                    }
                    if(!isset($_GET['sort_datum']) && !isset($_GET['sort_placen'])) {
                        $sql = "select r.racun_id, r.mjesec, r.iznos, r.placen, k.email from racun r, korisnik k where r.OIB_korisnik_rod = k.OIB_korisnik LIMIT $startrow, 7";
                    }
                    $rs = $baza->selectDB($sql);
        
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Broj računa</th><th><a style='text-decoration: none; color: #30323d;' href='popis_racuna.php?sort_datum=true'>Mjesec</a></th><th>Iznos računa</th><th><a style='text-decoration: none; color: #30323d;' href='popis_racuna.php?sort_placen=true'>Račun plaćen</a></th><th>Kontakt platitelja</th></tr>\n";
        
                    while (list($br, $mjesec, $iznos, $placen, $kontakt) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$mjesec</td>
                        <td>$iznos kn</td>
                        <td>";
                        if($placen) {
                            echo "Da";
                        } else {
                            echo "Ne";
                        }
                        echo "</td>
                        <td><a style='color: #30323d;' href=mailto:$kontakt>$kontakt</a></td>
                        </tr>";
                    }
                    echo "</table>\n";
        
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;
        
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
        
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                }
            ?>
        </section>
    </body>
    <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="../o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
    </footer>
</html>