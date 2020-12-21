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

    if(isset($_POST['izdaj'])) {
        $iznos_racuna = $_POST["iznos_racuna"];
        $evidencija_id = $_POST["evidencija_id"];
        $platitelj = $_POST['platitelj'];
        
        $sql = "insert into racun (mjesec, iznos, placen, OIB_korisnik_mod, OIB_korisnik_rod, evidencija_id) values ('$now', '$iznos_racuna', false, '$korisnik_id', '$platitelj', '$evidencija_id')";
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
            <form novalidate method="POST" name="form_prijava_kreacija" action="kreiraj_racun.php">
                    <label>Iznos: </label><br>
                    <input id="iznos_racuna" name="iznos_racuna" type="text"/><br>
                    <label>Platitelj: </label><br>
                    <input id="platitelj" name="platitelj" type="number"/><br>
                    <label>Šifra evidencije: </label><br>
                    <input id="evidencija_id" name="evidencija_id" type="number"/><br>
                    <input id="izdaj" name="izdaj" type="submit" value="Pošalji račun" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>