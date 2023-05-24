<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voitures</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/styles.css">
</head>
<body>
    <header>
  
    </header>

    <main>
        
        <h1>Voici nos Véhicules</h1>

        <?php
            $sql = "SELECT v.id_voiture, v.immatriculation, v.compteur, m.libelle AS modele, ma.libelle AS marque, m.image
                    FROM voiture v
                    INNER JOIN modele m ON v.id_modele = m.id_modele
                    INNER JOIN marque ma ON m.id_marque = ma.id_marque";
            $requete = mysqli_query($con, $sql);

            echo "<div class='table-container'><table style='border-collapse: collapse;'>";
            echo "<tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Plaque d'immatriculation</th>
                    <th>Compteur</th>
                  </tr>";

            $compteur = 0;

            while ($resultat = mysqli_fetch_array($requete)) {
                $compteur++;
                $classe = ($compteur % 2 == 0) ? "even" : "odd";
            
                echo "<tr class='" . $classe . "'>
                        <td>" . $resultat["marque"] . "</td>
                        <td>" . $resultat["modele"] . "</td>
                        <td>" . $resultat["immatriculation"] . "</td>
                        <td>" . $resultat["compteur"] . " Km</td>
                      </tr>";

                $cheminImage = "../../Resources/Images_voitures/" . $resultat["image"];
                echo "<tr>
                        <td>
                            <img src='" . $cheminImage . "' alt='Image du modèle'>
                        </td>
                      </tr>"; 

            }

            echo "</table></div>";
        ?>

    </main>

    <footer>
    </footer>
</body>
</html>
