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

    if(isset($_POST['unesi_ev'])) {
        $mjesec = $_POST["mjesec"];
        $oib = $_POST["oib_dijete"];
        $vrtic_id = $_POST["vrtic_id"];
        
        $sql = "insert into evidencija (mjesec, djecji_vrtic_id, OIB_korisnik_mod) values ('$mjesec', $vrtic_id, $korisnik_id)";
        $rs = $baza->selectDB($sql);
        $sql = "select evidencija_id from evidencija order by 1 desc limit 1";
        $rs = $baza->selectDB($sql);
        while(list($ev) = $rs->fetch_array()) {
            $evidencija_id = $ev;
        }
        $sql = "insert into evidentirano(evidencija_id, OIB_dijete, broj_dolazaka) values ('$evidencija_id', '$oib', 0)";
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
            <form novalidate method="POST" name="form_prijava_kreacija" action="kreiraj_evidenciju.php">
                    <label>Mjesec: </label><br>
                    <input id="mjesec" name="mjesec" type="text"/><br>
                    <label>OIB djeteta: </label><br>
                    <input id="oib_dijete" name="oib_dijete" type="number"/><br>
                    <label>Šifra vašeg vrtića: </label><br>
                    <input id="vrtic_id" name="vrtic_id" type="number"/><br>
                    <input id="unesi_ev" name="unesi_ev" type="submit" value="Kreiraj evidenciju" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>