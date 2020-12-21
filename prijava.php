<?php
    include("vanjske_biblioteke/sesija.class.php");
    include("vanjske_biblioteke/baza.class.php");

    $baza = new Baza();
    $username = $password = "";
    $userpwerr = $activatederer = "";
    $now = date("Y-m-d H:i:s");

    $baza->spojiDB();

    if ($baza->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }

    if(isset($_POST['korisnicko_ime'], $_POST['lozinka'])) {
        $username = trim($_POST["korisnicko_ime"]);
        $password = trim($_POST["lozinka"]);
        $passwordsha1 = sha1($password);
        $sql = "select OIB_korisnik, lozinka_sha1, uloga_id, aktiviran from korisnik where korisnicko_ime = '$username'";
        $rs = $baza->selectDB($sql);
        while (list($id, $db_password, $uloga, $aktiviran) = $rs->fetch_array()) {
            if($aktiviran) {
                if($passwordsha1 === $db_password) {
                    Sesija::kreirajKorisnika($username, $uloga, $id);
                    $sql = "insert into dnevnik (vrijeme, OIB_korisnik, tip_id) values ('$now', '$id', 1)";
                    $rs = $baza->selectDB($sql);
                    header("Location:index.php");
                } else {
                    $userpwerr = "Pogrešan unos!";
                }
            } else {
                $activatederer = "Račun nije aktiviran ili je blokiran";
            }
        }
        $rs->close();
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
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Architects+Daughter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="javascript/provjere_prijava.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    
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
            <form novalidate method="POST" name="form_prijava" action="prijava.php">
                <label>Korisničko ime:</label><br>
                <input id="korisnicko_ime" name="korisnicko_ime" type="text" required="required" placeholder=""/><br>
                <label>Lozinka:</label><br>
                <input id="lozinka" name="lozinka" type="password" required="required"/><br>
                <input id="prijavi" name="submit" type="submit" value="Prijavi se" style="font-family: 'Amatic SC', cursive;"/><br>
                <input name="remember_me" type="checkbox" value="zapamti_me"/>Zapamti me<br>
                <input name="zaboravljena" type="button" value="Zaboravljena lozinka" style="font-family: 'Amatic SC', cursive;"/><br>
            </form>
            <?php if(isset($userpwerr)) echo $userpwerr; if(isset($userpwerr)) echo $activatederer;?>
            <table>
                <tr>
                    <td>Administrator</td>
                    <td>admin</td>
                    <td>admin</td>
                </tr>
                <tr>
                    <td>Moderator</td>
                    <td>mod</td>
                    <td>mod</td>
                </tr>
                <tr>
                    <td>Registrirani korisnik</td>
                    <td>reg</td>
                    <td>reg</td>
                </tr>
            </table>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>