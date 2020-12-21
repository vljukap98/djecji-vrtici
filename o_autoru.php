<?php
    include("vanjske_biblioteke/sesija.class.php");

    Sesija::kreirajSesiju();
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
            <div class="sadrzaj">
                <img src="slike/default.jpg" alt="Moja slika">
                <p>Ime i prezime: Luka Jaković</p>
                <p>Broj indeksa: 46194</p>
                <a style='color: #30323d;' href="mailto:ljakovic@foi.hr">ljakovic@foi.hr</a>
            </div><br>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>