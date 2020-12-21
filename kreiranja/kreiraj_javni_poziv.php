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

    if(isset($_POST['unesi_jp'])) {
        $rok = $_POST["rok"];
        $kapacitet = $_POST["javni_poziv_id"];
        $vrtic_id = $_POST["vrtić_id"];
        
        $sql = "insert into javni_poziv (datum, broj_prijava, OIB_korisnik, djecji_vrtic_id) values ('$rok', $kapacitet, $korisnik_id, $vrtic_id)";
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
            <form novalidate method="POST" name="form_prijava_kreacija" action="kreiraj_javni_poziv.php">
                    <label>Rok za slanje prijava: </label><br>
                    <input id="rok" name="rok" type="text"/><br>
                    <label>Broj mjesta za prijavu: </label><br>
                    <input id="javni_poziv_id" name="javni_poziv_id" type="number"/><br>
                    <label>Šifra vašeg vrtića: </label><br>
                    <input id="vrtić_id" name="vrtić_id" type="number"/><br>
                    <input id="unesi_jp" name="unesi_jp" type="submit" value="Kreiraj novi javni poziv" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>