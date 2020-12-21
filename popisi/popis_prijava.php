<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
    $baza = new Baza();
    $baza->spojiDB();


    if(isset($_GET['prihvati'])) {
        $prijava_id= $_GET['prihvati'];
        $sql = "update prijava set prihvaceno=true where prijava_id = $prijava_id";
        $rs = $baza->selectDB($sql);
        if ($baza->pogreskaDB()) {
            echo "Problem kod upita na bazu podataka!";
            exit;
        }
        $now = date("Y-m-d H:i:s");
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 4)";
        $rs = $baza->selectDB($sql);
    }
    if(isset($_GET['odobri'])) {
        $prijava_id = $_GET['odobri'];
        $sql = "update prijava set odobrena=true where prijava_id = $prijava_id";
        $rs = $baza->selectDB($sql);
        if ($baza->pogreskaDB()) {
            echo "Problem kod upita na bazu podataka!";
            exit;
        }
        $now = date("Y-m-d H:i:s");
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 4)";
        $rs = $baza->selectDB($sql);
    }
    if(isset($_GET['odustani'])) {
        $prijava_id = $_GET['odustani'];
        $sql = "delete from dijete_prijavljeno where prijava_id = $prijava_id";
        $rs = $baza->selectDB($sql);
        $sql = "delete from prijava where prijava_id = $prijava_id";
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
                echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_prijavu.php'>Kreiraj prijavu</a>";

                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }
                
                $sql = "select p.prijava_id, d.ime, d.prezime, p.datum, p.odobrena, p.prihvaceno from dijete d, korisnik k, dijete_prijavljeno dp, prijava p where d.roditelj_OIB = k.OIB_korisnik and p.prijava_id = dp.prijava_id and dp.OIB_dijete = d.OIB_dijete and k.korisnicko_ime = '$korisnik' LIMIT $startrow, 7";

                $rs = $baza->selectDB($sql);

                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }
                echo "<table><tr><th>Dijete</th><th>Datum prijave</th><th>Prijava odobrena</th><th>Objavljivanje slika</th></tr>\n";

                while (list($prijava, $ime, $prezime, $datum, $odobreno, $prihvaceno) = $rs->fetch_array()) {
                    echo "<tr>
                    <td>$ime $prezime</td>
                    <td>$datum</td>
                    <td>"; if($odobreno) echo "Da"; else echo "Ne"; echo "</td>
                    <td>";  if(!$prihvaceno) echo "Ne";
                            if(!$prihvaceno && $odobreno) {
                                echo "<td><a style='text-decoration: none; color: #30323d;' href='popis_prijava.php?prihvati=$prijava'>Prihvati objavljivanje</a></td>";
                            } elseif($prihvaceno) {
                                echo "Da";
                        } echo "</td>";
                        if(($odobreno && !$prihvaceno) || (!$odobreno && !$prihvaceno)) {
                            echo "<td><a style='text-decoration: none; color: #30323d;' href='popis_prijava.php?odustani=$prijava'>Odustani od prijave</a></td>";
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
                echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_prijavu.php'>Kreiraj prijavu</a>";
                
                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }
                    
                $sql = "select jp.javni_poziv_id, p.prijava_id, p.datum, p.odobrena, p.prihvaceno, k.email from javni_poziv jp, prijava p, korisnik k where jp.javni_poziv_id = p.javni_poziv_id and p.OIB_korisnik_rod = k.OIB_korisnik and jp.OIB_korisnik = '$korisnik_id' LIMIT $startrow, 7";
    
                $rs = $baza->selectDB($sql);
    
                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }
                echo "<table><tr><th>Šifra javnog poziva</th><th>Šifra prijave</th><th>Datum izrade prijave</th><th>Prijava odobrena</th><th>Objavljivanje slika</th><th>Kontakt roditelja</th></tr>\n";
    
                while (list($brjp, $brp, $datum, $odobrena, $prihvaceno, $kontakt) = $rs->fetch_array()) {
                    echo "<tr>
                    <td>$brjp</td>
                    <td>$brp</td>
                    <td>$datum</td>
                    <td>";
                    if($odobrena) {
                        echo "Da";
                    } else {
                        echo "Ne";
                    }
                    
                    echo "</td>
                    <td>";
                    if($prihvaceno) {
                        echo "Da";
                    } else {
                        echo "Ne";
                    }
                    echo "</td>
                    <td><a style='color: #30323d;' href=mailto:$kontakt>$kontakt</a></td>";
                    if(!$odobrena) {
                        echo "<td><a style='text-decoration: none; color: #30323d;' href='popis_prijava.php?odobri=$brp'>Odobri prijavu</a></td>";
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
            } elseif($uloga === '1') {
                if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                    $startrow = 0;
                } else {
                    $startrow = (int)$_GET['startrow'];
                }
                
                $sql = "select p.prijava_id, d.ime, d.prezime, p.datum, p.odobrena, p.prihvaceno from dijete d, korisnik k, dijete_prijavljeno dp, prijava p where d.roditelj_OIB = k.OIB_korisnik and p.prijava_id = dp.prijava_id and dp.OIB_dijete = d.OIB_dijete LIMIT $startrow, 7";

                $rs = $baza->selectDB($sql);

                if ($baza->pogreskaDB()) {
                    echo "Problem kod upita na bazu podataka!";
                    exit;
                }
                echo "<table><tr><th>Dijete</th><th>Datum prijave</th><th>Prijava odobrena</th><th>Objavljivanje slika</th></tr>\n";

                while (list($prijava, $ime, $prezime, $datum, $odobreno, $prihvaceno) = $rs->fetch_array()) {
                    echo "<tr>
                    <td>$ime $prezime</td>
                    <td>$datum</td>
                    <td>"; if($odobreno) echo "Da"; else echo "Ne"; echo "</td>
                    <td>";  if(!$prihvaceno) echo "Ne";
                            if(!$prihvaceno && $odobreno) {
                            } elseif($prihvaceno) {
                                echo "Da";
                        } echo "</td>";
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