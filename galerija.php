<?php
    include_once("vanjske_biblioteke/sesija.class.php");

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
                $putanja = dirname($_SERVER['REQUEST_URI'], 2);
                include './navigacija.php';
            ?>
        </header>
        <section>
            <div class="sadrzaj">
                <?php
                    if(isset($_GET['putanja'])) {
                        $putanja = $_GET['putanja'] . "/*.*";
                        $files = glob($putanja);
                        for ($i=0; $i<count($files); $i++)
                        {
                            $image = $files[$i];
                            $supported_file = array(
                                    'gif',
                                    'jpg',
                                    'jpeg',
                                    'png'
                            );
        
                            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                            if (in_array($ext, $supported_file)) {
                                echo '<img src="'.$image .'" width="200" height="200" alt="'.$putanja.'" />'."<br>";
                            } else {
                                    continue;
                            }
                        }
                    }
                ?>
            </div>
        </section>
        <footer>
            <address>
                <p><small><a style='text-decoration: none; color: #30323d;' href="o_autoru.php">&copy; 2020. Luka Jakovic</a></small></p><br>
            </address>
        </footer>
    </body>
</html>