<?php
    include("vanjske_biblioteke/sesija.class.php");
    include("vanjske_biblioteke/baza.class.php");
    $now = date("Y-m-d H:i:s");
    $baza = new Baza();
    $baza->spojiDB();

    if(!isset($_SESSION['korisnik'])) {
        Sesija::kreirajSesiju();
    }

    if(isset($_GET['odjava'])) {
        $id = $_SESSION['id'];
        $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$id', 2)";
        $rs = $baza->selectDB($sql);
        $baza->zatvoriDB();
        session_unset();
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dječji vrtići</title>
        <meta charset="UTF-8">
        <meta name="author" content="LJ">

        <link href="css/stil.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Architects+Daughter&display=swap" rel="stylesheet"> 
    </head>
    <body style="background-image: url(slike/index-slika.jpg)">
        <header>
            <h1><a href="index.php">Dječji vrtići</a></h1>
            <?php
                $putanja = dirname($_SERVER['REQUEST_URI']);
                include './navigacija.php';
            ?>
        </header>
        <section>
            <h2>Dobro došli na stranicu dječjih vrtića</h2>
            <?php
                if(!isset($_SESSION['korisnik'])) {
                    echo "<p>Prijavite se za odabir savršenog vrtića za vaše dijete</p>
                    <form method='GET' name='index_registracija' action='prijava.php'>
                        <input name='submit' type='submit' value='Prijavi se' style='font-family: Amatic SC, cursive;'/><br>
                    </form><br>";
                }
            ?>
            <div class="sadrzaj">
                <p>Savršen odabir vrtića vas tek čeka</p>
                <img src="slike/trokutici/1.jpg" width="300" alt="Slika" />
                <img src="slike/kockice/1.jpg" width="300" alt="Slika" />
                <img src="slike/cvijetic/1.jpg" width="300" alt="Slika" />
                <img src="slike/kolacici/1.jpg" width="300" alt="Slika" />
            </div>
            <?php
                if(!isset($_SESSION['korisnik'])) {
                    echo "<form method='GET' name='index_registracija' action='registracija.php'>
                    <p>Nemate račun?</p>
                    <input name='submit' type='submit' value='Registriraj se' style='font-family: Amatic SC, cursive;'/><br>
                    </form><br>";
                }
            ?>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>