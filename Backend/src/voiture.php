<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
