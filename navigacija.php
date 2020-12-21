<?php
    include_once("vanjske_biblioteke/sesija.class.php");

    echo "<nav>";

    if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "3"){
        echo "<a href=\"$putanja/popisi/popis_vrtica.php\">Dječji vrtići</a>
        <a href=\"$putanja/popisi/popis_javnih_poziva.php\">Javni pozivi</a>
        <a href=\"$putanja/popisi/popis_prijava.php\">Prijave</a>
        <a href=\"$putanja/popisi/popis_evidencija.php\">Evidencija dolazaka</a>
        <a href=\"$putanja/popisi/popis_racuna.php\">Računi</a>
        <a href=\"$putanja/o_autoru.php\">O autoru</a>
        <a href=\"$putanja/dokumentacija.php\">Dokumentacija</a>
        <a href=\"$putanja/index.php?odjava=true\">Odjava</a>";
    } elseif(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "2"){
        //TODO moderator nav
        echo "<a href=\"$putanja/popisi/popis_vrtica.php\">Dječji vrtići</a>
        <a href=\"$putanja/popisi/popis_skupina.php\">Moje skupine</a>
        <a href=\"$putanja/popisi/popis_javnih_poziva.php\">Moji javni pozivi</a>
        <a href=\"$putanja/popisi/popis_prijava.php\">Prijave</a>
        <a href=\"$putanja/popisi/popis_evidencija.php\">Evidencija djece</a>
        <a href=\"$putanja/popisi/popis_racuna.php\">Računi</a>
        <a href=\"$putanja/o_autoru.php\">O autoru</a>
        <a href=\"$putanja/dokumentacija.php\">Dokumentacija</a>
        <a href=\"$putanja/index.php?odjava=true\">Odjava</a>";
        
    } elseif(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "1"){
        //TODO administrator nav
        //ocjena vrtica
        //dnevnik log ispis
        echo "<a href=\"$putanja/popisi/popis_vrtica.php\">Dječji vrtići</a>
        <a href=\"$putanja/popisi/popis_korisnika.php\">Korisnici</a>
        <a href=\"$putanja/popisi/popis_javnih_poziva.php\">Javni pozivi</a>
        <a href=\"$putanja/popisi/popis_prijava.php\">Prijave</a>
        <a href=\"$putanja/popisi/popis_evidencija.php\">Evidencija dolazaka</a>
        <a href=\"$putanja/popisi/popis_racuna.php\">Računi</a>
        <a href=\"$putanja/dnevnik.php\">Dnevnik sustava</a>
        <a href=\"$putanja/o_autoru.php\">O autoru</a>
        <a href=\"$putanja/dokumentacija.php\">Dokumentacija</a>
        <a href=\"$putanja/index.php?odjava=true\">Odjava</a>";

    } else {
        echo "<a href=\"$putanja/popisi/popis_vrtica.php\">Dječji vrtići</a>
        <a href=\"$putanja/popisi/popis_javnih_poziva.php\">Javni pozivi</a>
        <a href=\"$putanja/prijava.php\">Prijava</a>
        <a href=\"$putanja/registracija.php\">Registracija</a>
        <a href=\"$putanja/o_autoru.php\">O autoru</a>
        <a href=\"$putanja/dokumentacija.php\">Dokumentacija</a>";
    }
        
    echo "</nav><br>";
?>