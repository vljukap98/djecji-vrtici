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
            <div class="sadrzaj_dokumentacija">
                <h2>Opis projektnog zadatka</h2>
                <p>Glavna tema projektnog zadatka bila je kreiranje sustava za upravljanje dječjim vrtićima.</p>
                <p>Sustav je trebao moći dopustiti 4 vrste korisnika</p>
                <ul>
                    <li>Neregistrirani korisnik</li>
                    <li>Registrirani korisnik</li>
                    <li>Moderator</li>
                    <li>Administrator</li>
                </ul>
                <p>
                    Neregistrirani korisnik treba imati najmanje ovlasti. U ovom slučaju može samo pregledavati popis vrtića,
                    popis javnih poziva, gdje može sortirati po stupcu do kad se može slati prijava za taj javni poziv ili filtrirati
                    ispis javnih poziva prema dječjim vrtićima, može se registrirati, ili prijaviti ukoliko ima registriran račun 
                    te također može otvoriti stranicu "O autoru" i "Dokumentacija".
                </p>
                <p>
                    Registrirani korisnik ili roditelj, također može raditi isto sa stranicama "Dječji vrtići", "Javni pozivi", 
                    "O autoru" te "Dokumentacija" kao i neregistrirani korisnik. Ono što on može je pregledati popis prijava koje
                    je poslao za određeni javni poziv, odnosno vrtić, može unijeti novu prijavu, može pregledati popis dolazaka svoje
                    djece u kojem su vrtiću za određeni mjesec. Zadnja mogućnost je pregled računa mjesečno i mogućnost označavanja
                    određenog računa kao plaćenog.
                </p>
                <p>
                    Moderator ili vlasnik vrtića, može raditi isto kao prijašnja dva korisnika uz mogućnosti pregleda javnih poziva
                    samo za svoj vrtić, unošenje novog za svoj vrtić, pregled skupina i kreiranje nove skupine. Također ima mogućnost
                    pregleda svih prijava za njegov vrtić gdje može odobriti prijavu ili kreirati novu. Zadnje što može je pregledati
                    evidenciju mjesečno za taj vrtić, kreiranje nove evidencije te pregled računa roditelja i izdavanje novih računa.
                </p>
                <p>
                    Poslijednja vrsta korisnika je administrator koji ima sve ovlasti, one prijašnje navedene uz naravno pregled dnevnika
                    radnje ostalih korisnika sustava, može vidjeti određenu statistiku za vrtić i na mjesečnoj bazi unosi ocjenu za
                    svaki dječji vrtić u intervalu od 1 do 10.
                </p>
            </div><br>
            <div class="sadrzaj_dokumentacija">
                <h2>Opis projektnog rješenja</h2>
                <p>U ovom projektnom rješenju realizirane su sljedeće funkcionalnosti:</p>
                <ul>
                    <li>
                        neregistrirani korisnik može pregledavati vrtiće, pregledavati javne pozive prema datumu isteka te
                        filtrirati prema nazivu vrtića, može se prijaviti ukoliko ima registriran i aktiviran račun, ukoliko ne
                        mora se registrirati
                    </li>
                    <li>
                        registrirani korisnik može također pregledavati vrtiće i javne pozive uz sortiranje i filtriranje,
                        ukoliko želi prijaviti dijete može ga prijaviti i pregledati svoj popis prijava te ako je prijava
                        odobrena može prihvatiti uvjete postavljanja fotografija djeteta na poslužitelj ili odbiti i obrisati
                        prijavu, može pregledati popis dolazaka svog djeteta i račune koje može označiti kao plaćene ukoliko su označeni kao neplaćeni
                    </li>
                    <li>
                        moderator može vidjeti popis vrtića u sustavu, može vidjeti javne pozive, skupine, prijave, evidenciju i 
                        račune za svoj vrtić, ukoliko želi može krerirati novu skupinu, novi javni poziv, prijaviti dijete ukoliko roditelj
                        nije to u mogućnosti, kod popisa prijava može odabrati onu prijavu koju želi ako želi prihvatiti dijete u vrtić,
                        može kreirati novu evidenciju za novi mjesec i zabilježiti dolazak djeteta za određeni mjesec te izdati novi račun
                        roditelju
                    </li>
                    <li>
                        administrator može gledati podatke za sve tablice iz baze, ali uređivati, podatke za vrtiće i korisnike dok 
                        na ostalima samo može pretraživati, filtrirati prikaz podataka ili sortirati podatke prikazane na tablicama, 
                        može vidjeti log sustava, može aktivirati korisnički račun ako je on blokiran, odnosno neaktiviran nakon registracije,
                        može dodati moderatora pa vrtić i dodijeliti mu taj vrtić, može ocijeniti vrtić
                    </li>
                </ul>
            </div><br>
            <div class="sadrzaj_dokumentacija">
                <h2>ERA</h2>
                <img src="slike/era.png" width="840"/>
                <p>Gornja slika prikazuje ERA model u kojem su tablice: korisnik, djecji_vrtic i dijete na naglasku</p>
            </div><br>
            <div class="sadrzaj_dokumentacija">
                <h2>Popis i opis skripata, mapa mjesta, navigacijski dijagram</h2>
                <p>glavni direktorij projekta</p>
                <ul>
                    <li>index.php -početna stranica projekta</li>
                    <li>o_autoru.php -stranica o autoru</li>
                    <li>dokumentacija.php -stranica za dokumentaciju</li>
                    <li>navigacija.php -odvojena skripta za prikazivanje navigacije</li>
                    <li>galerija.php -skripta za prikaz galerije za određeni vrtić</li>
                    <li>dnevnik.php -skripta za prikaz dnevnika (log sustava)</li>
                    <li>prijava.php -skripta za prijavu u sustav</li>
                    <li>registracija.php -skripta za registraciju u sustav</li>
                    <li>css</li>
                    <ul>
                        <li>stil.css -stilska datoteka za dizajn svih dokumenata web mjesta</li>
                    </ul>
                    <li>izvorne_datoteke</li>
                    <ul>
                        <li>WebDiP2019x050.sql -forward engineer mysql skripta korištene baze podataka</li>
                    </ul>
                    <li>javascript</li>
                    <ul>
                        <li>provjere_prijava.js -skripta za provjeru unosa na klijentskoj strani za prijavu</li>
                        <li>provjere_registracija.js -skripta za provjeru unosa na klijentskoj strani za registraciju uz generiranje captcha-a</li>
                    </ul>
                    <li>kreiranja</li>
                    <ul>
                        <li>kreiraj_evidenciju.php -skripta za unos evidencije u bazu</li>
                        <li>kreiraj_javni_poziv.php -skripta za unos javnog poziva u bazu</li>
                        <li>kreiraj_korisnika.php -skripta za unos novog registriranog korisnika</li>
                        <li>kreiraj_moderatora.php -skripta za unos novog moderatora</li>
                        <li>kreiraj_prijavu.php -skripta za unos prijave djeteta</li>
                        <li>kreiraj_racun.php -skripta za izdavanje računa roditelju</li>
                        <li>kreiraj_skupinu.php -skripta za kreiranje nove skupine</li>
                        <li>kreiraj_vrtic.php -skripta za kreiranje novog vrtića</li>
                        <li>ocijeni_vrtic.php -skripta za ocjenjivanje vrtića</li>
                    </ul>
                    <li>popisi</li>
                    <ul>
                        <li>popis_evidencija.php -skripta za ispis tablice u kojoj su prikazane evidencije</li>
                        <li>popis_javnih_poziva.php -skripta za ispis tablice u kojoj su prikazani javni pozivi</li>
                        <li>popis_korisnika.php -skripta za ispis svih korisnika i njegovih atributa u tablicu</li>
                        <li>popis_prijava.php -skripta za ispis prijava u tablicu</li>
                        <li>popis_racuna.php -skripta za ispis popisa racuna unutar tablice</li>
                        <li>popis_skupina.php -skripta za ispis skupina u tablicu</li>
                        <li>popis_vrtica.php -skripta za ispis vrtića u tablicu</li>
                    </ul>
                    <li>
                        slike - mapa za spremanje slika, svaki vrtić ima svoju mapu
                        <ul>
                        <li>cvijetic<ul><li>1.jpg</li></ul></li>
                        <li>duga<ul><li>1.jpg</li></ul></li>
                        <li>kockice<ul><li>1.jpg</li></ul></li>
                        <li>kolacici<ul><li>1.jpg</li></ul></li>
                        <li>pahulje<ul><li>1.jpg</li></ul></li>
                        <li>prvomajsko<ul><li>1.jpg</li></ul></li>
                        <li>srecica<ul><li>1.jpg</li></ul></li>
                        <li>sunasce<ul><li>1.jpg</li></ul></li>
                        <li>trokutici<ul><li>1.jpg</li></ul></li>
                        <li>Tikvica</li>
                        <li>zrno<ul><li>1.jpg</li><li>2.jpg</li></ul></li>
                        </ul>
                    </li>
                    <ul>
                        <li>default.jpg -slika studenta za prikaz kao u indeksu</li>
                        <li>era.jpg -slika za prikaz era modela</li>
                        <li>index-slika.jpg -pozadinska slika za prikaz na svim stranicama</li>
                        <li>navigacijski_dijagram.png -slika za prikaz navigacijskog dijagrama</li>
                    </ul>
                    <li>vanjske_biblioteke</li>
                    <ul>
                        <li>baza.class.php -skripta za rad s bazom podataka preuzeta s nastave</li>
                        <li>sesija.class.php -skripta za rad sa sesijama s nastave</li>
                    </ul>
                </ul>
                <h3>Navigacijski dijagrami</h3>
                <img src="slike/navigacijski_dijagram.png" width="840"/>
            </div><br>
            <div class="sadrzaj_dokumentacija">
                <h2>Popis i opis korištenih tehnologija i alata</h2>
                <p>Alati</p>
                <ul>
                    <li>XAMPP -apache i mysql baza podataka (phpmyadmin)</li>
                    <li>MySQL WorkBench -export era modela iz mysql baze</li>
                    <li>Visual Studio Code -pisanje skripti</li>
                    <li>Google Chrome -testiranje kroz razvoj</li>
                    <li>Mozilla Firefox -testiranje kroz razvoj</li>
                </ul>
                <p>Tehnologije</p>
                <ul>
                    <li>HTML -kostur dokumenata</li>
                    <li>MySQL -izrada baze podataka, pisanje upita prema bazi</li>
                    <li>JavaScript -izrada skripata za klijentsku stranu</li>
                    <li>JQuery -izrada skripata za klijentsku stranu</li>
                    <li>PHP -izrada skripata za poslužiteljsku stranu</li>
                </ul>
            </div><br>
            <div class="sadrzaj_dokumentacija">
                <h2>Popis i opis vanjskih biblioteka</h2>
                <ul>
                    <li>baza.class.php -skripta za rad s bazom podataka preuzeta s nastave</li>
                    <li>sesija.class.php -skripta za rad sa sesijama s nastave</li>
                </ul>
            </div><br>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>