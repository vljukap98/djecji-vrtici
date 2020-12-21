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

    if(isset($_POST['unesi_skupinu'])) {
        $naziv_skupine = $_POST["naziv_skupine"];
        $cijena = $_POST["cijena"];
        $kapacitet = $_POST["kapacitet"];
        $vrtic_id = $_POST["vrtic_id"];
        
        $sql = "insert into skupina (naziv_skupine, cijena, OIB_korisnik) values ('$naziv_skupine',$cijena, '$korisnik_id')";
        $rs = $baza->selectDB($sql);
        $sql = "select skupina_id from skupina order by 1 desc limit 1";
        $rs = $baza->selectDB($sql);
        while(list($sk) = $rs->fetch_array()) {
            $skupina_id = $sk;
        }
        $sql = "insert into skupina_pripada(djecji_vrtic_id, skupina_id, broj_djece) values ($vrtic_id, $skupina_id, $kapacitet)";
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
            <form novalidate method="POST" name="form_prijava_kreacija" action="kreiraj_skupinu.php">
                    <label>Naziv skupine: </label><br>
                    <input id="naziv_skupine" name="naziv_skupine" type="text"/><br>
                    <label>Cijena: </label><br>
                    <input id="cijena" name="cijena" type="number"/><br>
                    <label>Kapacitet djece:</label><br>
                    <input id="kapacitet" name="kapacitet" type="number"/><br>
                    <label>Šifra vašeg vrtića: </label><br>
                    <input id="vrtic_id" name="vrtic_id" type="number"/><br>
                    <input id="unesi_skupinu" name="unesi_skupinu" type="submit" value="Kreriraj skupinu" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>