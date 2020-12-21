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

    if(isset($_POST['dodajvrtic'])) {
        $naziv = $_POST["naziv"];
        $adresa = $_POST["adresa"];
        $mod = $_POST["mod"];
        $structure = ".././slike/$naziv";

        mkdir($structure, 0777);
        $sql = "insert into  djecji_vrtic (naziv_djecjeg_vrtica, adresa, galerija, OIB_korisnik_admin, OIB_korisnik_mod) values ('$naziv', '$adresa', '$naziv', '$korisnik_id', '$mod')";
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
            <form novalidate method="POST" name="form_kreiraj_vrtic" action="kreiraj_vrtic.php">
                <label>Ime novog dječjeg vrtića: </label><br>
                <input id="naziv" name="naziv" type="text"/><br>
                <label>Adresa:</label><br>
                <input id="adresa" name="adresa" type="text"/><br>
                <label>Šifra dodijeljenog moderatora:</label><br>
                <input id="mod" name="mod" type="number"/><br>
                <input id="dodajvrtic" name="dodajvrtic" type="submit" value="Kreiraj novi vrtić" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>