<!-- Mettre le "session_start" dessous --> 
<?php
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clients</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/styles.css">
</head>
<body>
    <header>
        <!-- En-tête de la page -->
    </header>

    <main>
    <h1>Guest History</h1>
    <?php
        include "../outils/biblio.php";

        $con = connexion();
        //requête sql ci-dessous
        $sql = "SELECT * FROM client";
        $requete = mysqli_query($con, $sql);

        echo "<table style='border-collapse: collapse;'>";
        echo "<tr><th style='border: 1px solid black;'>Nom</th>
            <th style='border: 1px solid black;'>Prénom</th>
            <th style='border: 1px solid black;'>Adresse</th></tr>";

        $compteur = 0;

        while ($resultat =mysqli_fetch_array($requete)) {
            $compteur++;

            $classe = ($compteur % 2 == 0) ? "even" : "odd";

            echo "<tr class='" . $classe . "'>
                <td style='border: 1px solid black;'>" . $resultat["nom"] . "</td>
                <td style='border: 1px solid black;'>" . $resultat["prenom"] . "</td>
                <td style='border: 1px solid black;'>" . $resultat["adresse"] . "</td></tr>";
        }

        echo "</table>";

        //!! SUPPRIMER PLUS TARD !!\\
        // $test_2 = mysqli_fetch_array($requete);
        // echo $test_2["nom"];
        // header('Location: http://www.google.com/');
    ?>

    </main>

    <footer>
        <!-- Pied de page -->
    </footer>
</body>
</html>


<!-- TIPS - PHP  -->
<!-- 
    header('Location: http://www.google.com/'); => redirige vers une page, comme le target="_blank".



 -->
