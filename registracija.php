<?php
    include("vanjske_biblioteke/baza.class.php");

    $now = date("Y-m-d H:i:s");
    $baza = new Baza();
    $greska = false;

    $baza->spojiDB();

    if ($baza->pogreskaDB()) {
        echo "Problem kod upita na bazu podataka!";
        exit;
    }

    if(isset($_POST['registrirajse'])) {
        $korisnik_id = $_POST["oib"];
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $korisnicko_ime = $_POST["korisnicko_ime"];
        $email = $_POST["email"];
        $lozinka = $_POST["lozinka"];
        $ponovno = $_POST["ponovno"];

        $OIBPattern = "/^\d{11}$/";
        $nameSurnamePattern = "/^[A-ZČŠĆŽĐa-zčćžđš]+[^\d]{2,50}$/";
        $usernamePattern = "/^([a-zA-Z]+(\d?)+){5,20}$/";
        $emailPattern = "/^([a-zA-Z]+(\d?)+)(@)([a-zA-Z]+)(.com||.hr||.info){15,50}$/";
        $passwordPattern = "/^(?=.*\d)(?=.*[A-Z])(?!.*[^a-zA-Z0-9@#$^+=])(.{8,20})$/";

        if(!preg_match($OIBPattern, $korisnik_id)) {
            $greska = true;
        } if(!preg_match($nameSurnamePattern, $ime)) {
            $greska = true;
        } if(!preg_match($nameSurnamePattern, $prezime)) {
            $greska = true;
        } if(!preg_match($usernamePattern, $korisnicko_ime)) {
            $greska = true;
        } if(!preg_match($emailPattern, $email)) {
            $greska = true;
        } if(!preg_match($passwordPattern, $lozinka)) {
            $greska = true;
        } if($lozinka != $ponovno) {
            $greska = true;
        }
        if(!$greska) {
            $lozinka_sha1 = sha1($lozinka);
            
            $sql = "insert into korisnik (OIB_korisnik, ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, email, vrijeme_registracije, aktiviran, uloga_id) values ($korisnik_id, '$ime', '$prezime', '$korisnicko_ime', '$lozinka', '$lozinka_sha1', '$email', '$now', false, '3')";
            $rs = $baza->selectDB($sql);
        }
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
        <script src="javascript/provjere_registracija.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body style="background-image: url(slike/index-slika.jpg)" onload="createCaptcha()">
        <header>
            <h1><a href="index.php">Dječji vrtići</a></h1>
            <?php
                $putanja = dirname($_SERVER['REQUEST_URI']);
                include './navigacija.php';
            ?>
        </header>
        <section>
            <div class="sadrzaj">
                <?php if($greska) {echo "<p style='color: red; '>Pogrešno uneseni podaci</p>";}?>
                <form novalidate method="POST" name="from_registracija" action="registracija.php" onsubmit="validateCaptcha()">
                    <label>OIB:</label><br>
                    <input id="oib" name="oib" type="text" required="required" placeholder="11 znakova"/><br>
                    <label>Ime:</label><br>
                    <input id="ime" name="ime" type="text" required="required"/><br>
                    <label>Prezime:</label><br>
                    <input id="prezime" name="prezime" type="text" required="required"/><br>
                    <label>Korisničko ime:</label><br>
                    <input id="korisnicko_ime" name="korisnicko_ime" type="text" required="required" placeholder="korime1"/><br>
                    <label>E-mail:</label><br>
                    <input id="email" name="email" type="e-mail" required="required" placeholder="example@mail.org"/><br>
                    <label>Lozinka:</label><br>
                    <input id="lozinka" name="lozinka" type="password" required="required"/><br>
                    <label>Ponovite lozinku:</label><br>
                    <input id="ponovno" name="ponovno" type="password" required="required"/><br>
                    <div id="captcha">
                    </div>
                    <input type="text" placeholder="Unesite gornji tekst" id="cpatchaTextBox"/><br>
                    
                    <input id="registrirajse" name="registrirajse" type="submit" value="Registriraj se" style="font-family: 'Amatic SC', cursive;"/>
                </form>
            </div>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>