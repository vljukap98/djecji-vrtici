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

    if(isset($_POST['kreirajmod'])) {
        $oib = $_POST["oib"];
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $korisnicko_ime = $_POST["korisnicko_ime"];
        $email = $_POST["email"];
        $lozinka = $_POST["lozinka"];
        $lozinka_sha1 = sha1($lozinka);
        
        $sql = "insert into korisnik (OIB_korisnik, ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, email, vrijeme_registracije, aktiviran, uloga_id) values ($oib, '$ime', '$prezime', '$korisnicko_ime', '$lozinka', '$lozinka_sha1', '$email', '$now', true, '2')";
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
            <form novalidate method="POST" name="form_moderator" action="kreiraj_moderatora.php">
                <label>OIB:</label><br>
                <input id="oib" name="oib" type="text" required="required"/><br>
                <label>Ime:</label><br>
                <input id="ime" name="ime" type="text" required="required"/><br>
                <label>Prezime:</label><br>
                <input id="prezime" name="prezime" type="text" required="required"/><br>
                <label>Korisničko ime:</label><br>
                <input id="korisnicko_ime" name="korisnicko_ime" type="text" required="required"/><br>
                <label>E-mail:</label><br>
                <input id="email" name="email" type="e-mail" required="required"/><br>
                <label>Lozinka:</label><br>
                <input id="lozinka" name="lozinka" type="password" required="required"/><br>
                    
                <input id="kreirajmod" name="kreirajmod" type="submit" value="Kreiraj novog moderatora" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>