<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    if(!isset($_SESSION['korisnik'])) {
        Sesija::kreirajSesiju();
    } 
    if(isset($_SESSION['uloga'])){
        $uloga = $_SESSION['uloga'];
        $korisnik = $_SESSION['korisnik'];
        $korisnik_id = $_SESSION['id'];
    }
    $now = date("Y-m-d");

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

                if(isset($uloga) && $uloga === "3"){
                    echo "<form novalidate method='GET' name='form_filter' action='popis_javnih_poziva.php'>
                        <label>Pretražite po dječjem vrtiću:</label><br>
                        <input id='filter' name='filter' type='text'/>
                        <input name='button_filter' type='submit' value='Filtriraj' style='font-family: Amatic SC, cursive;'/><br>
                        </form>";
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $početak = 0;
                    } else {
                        $početak = (int)$_GET['startrow'];
                    }
    
                    if(isset($_GET["filter"])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $vrtic = $_GET["filter"];
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id and jp.datum > NOW() AND dv.naziv_djecjeg_vrtica LIKE  '%{$vrtic}%' LIMIT $početak, 7";
                    } 
                    if (isset($_GET["sort_rok"])) {
                        $now = date("Y-m-d H:i:s");
                        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 3)";
                        $rs = $baza->selectDB($sql);
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id and jp.datum > NOW() ORDER BY jp.datum LIMIT $početak, 7";
                    } 
                    if(!isset($_GET["sort_rok"]) && !isset($_GET["filter"])) {
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id and jp.datum > NOW() LIMIT $početak, 7";
                    }
    
                    $rs = $baza->selectDB($sql);
    
    
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                        
                    echo "<table><tr><th>Šifra javnog poziva</th><th><a style='text-decoration: none; color: #30323d;' href='popis_javnih_poziva.php?sort_rok=true'>Rok prijave</a></th><th>Broj prijava</th><th>Naziv vrtića</th><th>Adresa</th></tr>\n";
    
                    while (list($br, $datum, $brprijava, $djecjivrtic, $adresa) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$datum</td>
                        <td>$brprijava</td>
                        <td>Dječji vrtić '$djecjivrtic'</td>
                        <td>$adresa</td>
                        </tr>\n";
                    }
                    echo "</table>\n";
    
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($početak+7)."'>Sljedeća</a><br>";
                    $prethodna = $početak - 7;
    
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
    
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                } elseif(isset($uloga) && $uloga === '2') {
                    echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_javni_poziv.php'>Kreiraj javni poziv</a>";
                    
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                        
                    $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava from javni_poziv jp, korisnik k where jp.OIB_korisnik = k.OIB_korisnik and k.OIB_korisnik = '$korisnik_id' LIMIT $startrow, 7";
        
                    $baza->spojiDB();
                    $rs = $baza->selectDB($sql);
        
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Šifra javnog poziva</th><th>Rok prijave</th><th>Kapacitet prijava</th></tr>\n";
        
                    while (list($br, $datum, $brprijava) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$datum</td>
                        <td>$brprijava</td>
                        </tr>\n";
                    }
                    echo "</table>\n";
        
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($startrow+7)."'>Sljedeća</a><br>";
                    $prethodna = $startrow - 7;
        
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
        
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                } else {
                    echo "<form novalidate method='GET' name='form_filter' action='popis_javnih_poziva.php'>
                        <label>Pretražite po dječjem vrtiću:</label><br>
                        <input id='filter' name='filter' type='text'/>
                        <input name='button_filter' type='submit' value='Filtriraj' style='font-family: Amatic SC, cursive;'/><br>
                        </form>";
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $početak = 0;
                    } else {
                        $početak = (int)$_GET['startrow'];
                    }
    
                    if(isset($_GET["filter"])) {
                        $vrtic = $_GET["filter"];
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id AND dv.naziv_djecjeg_vrtica LIKE  '%{$vrtic}%' LIMIT $početak, 7";
                    } 
                    if (isset($_GET["sort_rok"])) {
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id ORDER BY jp.datum LIMIT $početak, 7";
                    } 
                    if(!isset($_GET["sort_rok"]) && !isset($_GET["filter"])) {
                        $sql = "select jp.javni_poziv_id, jp.datum, jp.broj_prijava, dv.naziv_djecjeg_vrtica, dv.adresa from javni_poziv jp, djecji_vrtic dv where jp.djecji_vrtic_id = dv.djecji_vrtic_id LIMIT $početak, 7";
                    }
    
                    $baza->spojiDB();
                    $rs = $baza->selectDB($sql);
    
    
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                        
                    echo "<table><tr><th>Šifra javnog poziva</th><th><a style='text-decoration: none; color: #30323d;' href='popis_javnih_poziva.php?sort_rok=true'>Rok prijave</a></th><th>Broj prijava</th><th>Naziv vrtića</th><th>Adresa</th></tr>\n";
    
                    while (list($br, $datum, $brprijava, $djecjivrtic, $adresa) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$br</td>
                        <td>$datum</td>
                        <td>$brprijava</td>
                        <td>Dječji vrtić '$djecjivrtic'</td>
                        <td>$adresa</td>
                        </tr>\n";
                    }
                    echo "</table>\n";
    
                    echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.($početak+7)."'>Sljedeća</a><br>";
                    $prethodna = $početak - 7;
    
                    if ($prethodna >= 0)
                        echo "<a style='text-decoration: none; color: #30323d;' href='".$_SERVER['PHP_SELF'].'?startrow='.$prethodna."'>Prethodna</a>";
    
                    echo "</div>";
                    $rs->close();
                    $baza->zatvoriDB();
                }
            ?>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="../o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>