<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

    Sesija::kreirajSesiju();
    $uloga = $_SESSION['uloga'];
    $korisnik = $_SESSION['korisnik'];
    $korisnik_id = $_SESSION['id'];
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
                echo "<a style='text-decoration: none; color: #30323d;' href='../kreiranja/kreiraj_skupinu.php'>Kreiraj novu skupinu</a>";
                if($uloga === "2"){
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                        $startrow = 0;
                    } else {
                        $startrow = (int)$_GET['startrow'];
                    }
                    
                    $sql = "select s.naziv_skupine, s.cijena, sp.broj_djece from skupina s, skupina_pripada sp, korisnik k where s.skupina_id = sp.skupina_id and s.OIB_korisnik = k.OIB_korisnik and k.OIB_korisnik = '$korisnik_id' LIMIT $startrow, 7";
    
                    $rs = $baza->selectDB($sql);
    
                    if ($baza->pogreskaDB()) {
                        echo "Problem kod upita na bazu podataka!";
                        exit;
                    }
                    echo "<table><tr><th>Naziv skupine</th><th>Cijena</th><th>Kapacitet djece</th></tr>\n";
    
                    while (list($naziv, $cijena, $kapacitet) = $rs->fetch_array()) {
                        echo "<tr>
                        <td>$naziv</td>
                        <td>$cijena</td>
                        <td>$kapacitet</td>
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
                }
                ?>
        </section>
    </body>
    <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
    </footer>