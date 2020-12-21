<?php
    include_once("../vanjske_biblioteke/sesija.class.php");
    include("../vanjske_biblioteke/baza.class.php");

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

    if(isset($_POST['ocijeni'])) {
        $ocijena = $_POST["ocijena"];
        $vrtic_id = $_POST["vrtic_id"];
        
        $sql = "insert into ocjena_mjesecno (OIB_korisnik_admin, djecji_vrtic_id, `mjesec/godina`, ocjena) values ($korisnik_id, $vrtic_id,'$now', 5)";
        $rs = $baza->selectDB($sql);
        $now = date("Y-m-d H:i:s");
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$korisnik_id', 4)";
        $rs = $baza->selectDB($sql);
    }
    $baza->zatvoriDB();
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
            <form novalidate method="POST" name="form_ocieni" action="ocijeni_vrtic.php">
                <label>Ocjena (1-10): </label><br>
                <input id="ocijena" name="ocijena" type="number"/><br>
                <label>Šifra dječjeg vrtića:</label><br>
                <input id="vrtic_id" name="vrtic_id" type="number"/><br>
                <input id="ocijeni" name="ocijeni" type="submit" value="Daj ocjenu" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>