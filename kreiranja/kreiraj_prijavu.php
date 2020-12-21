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

    if(isset($_POST['unesi_prijavu'])) {
        $javni_poziv_id = $_POST["javni_poziv_id"];
        $dijete_oib = $_POST["dijete_oib"];
        $skupina_id = $_POST["skupina_id"];
        
        $sql = "insert into prijava (datum, OIB_korisnik_rod, skupina_id, javni_poziv_id) values ('$now', $korisnik_id, $skupina_id, $javni_poziv_id)";
        $rs = $baza->selectDB($sql);
        $sql = "select prijava_id from prijava order by 1 desc limit 1";
        $rs = $baza->selectDB($sql);
        while(list($pid) = $rs->fetch_array()) {
            $prijava_id = $pid;
        }
        $sql = "insert into dijete_prijavljeno (OIB_dijete, prijava_id) values ('$dijete_oib', '$prijava_id')";
        $rs = $baza->selectDB($sql);
        $sql = "update javni_poziv set broj_prijava = broj_prijava-1 where javni_poziv_id = $javni_poziv_id";
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
            <form novalidate method="POST" name="form_prijava_kreacija" action="kreiraj_prijavu.php">
                <label>Javni poziv: </label><br>
                <input id="javni_poziv_id" name="javni_poziv_id" type="number"/><br>
                <label>OIB djeteta:</label><br>
                <input id="dijete_oib" name="dijete_oib" type="text"/><br>
                <label>Broj skupine:</label><br>
                <input id="skupina_id" name="skupina_id" type="number"/><br>
                <input id="unesi_prijavu" name="unesi_prijavu" type="submit" value="Unesi prijavu" style="font-family: 'Amatic SC', cursive;"/>
            </form>
        </section>
        <footer>
            <address>
                <p><small>&copy; 2020. Luka Jakovic</small></p><br>
            </address>
        </footer>
    </body>
</html>