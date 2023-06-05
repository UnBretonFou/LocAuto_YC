<?php
session_start();
include "../outils/biblio.php";
$con = connexion(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/style_LRCM.css">
</head>
<body>
    <header>
        <a href="index.php" class="btn-accueil">Accueil</a>
        <form method="POST" action="../src/controlers/ajouter_vehicule.php">
            <h2>Ajouter un véhicule</h2>
            <label for="id_marque">Marque :</label>
            <select name="id_marque" required>
                <?php
                // On récupère tous les noms des clients de la base de données
                $sql = "SELECT id_marque, libelle FROM marque";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row["id_marque"] . "'>" . $row["libelle"] . "</option>";
                }
                ?>

            </select><br><br>
            <label for="id_modele">Modèle :</label>
            <select name="id_modele" required>
                <?php
                // Récupère tous les modèles de voiture de la base de données.
                $sql = "SELECT m.id_modele, m.libelle AS modele_libelle, c.id_categorie, c.libelle AS categorie_libelle
                        FROM modele m
                        INNER JOIN categorie c ON c.id_categorie = m.id_categorie";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row["id_modele"] . "'>" . $row["modele_libelle"] . " // " . $row["categorie_libelle"] . "</option>";
                }
                ?>
            </select><br><br> 
            <label for="immatriculation">Immatriculation :</label>
            <input type="varchar" name="immatriculation" required><br>
            <label for="compteur">Compteur :</label>
            <input type="int" name="compteur"><br><br>
            <!-- Bouton Ajouter -->
            <button type="submit" class="btn-ajouter">Ajouter</button>
        </form>
    </header>

    <main>
        <?php
        $sql = "SELECT v.id_voiture, v.immatriculation, v.compteur, m.libelle AS modele, ma.libelle AS marque, m.image
                FROM voiture v
                INNER JOIN modele m ON v.id_modele = m.id_modele
                INNER JOIN marque ma ON m.id_marque = ma.id_marque";
        $requete = mysqli_query($con, $sql);

        echo "<div class='table-container'><table style='border-collapse: collapse;'>";
        echo "<tr>
                <th>Image voiture</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Plaque Immatriculation</th>
                <th>Compteur</th>
                <th>Action</th>
            </tr>";

        $compteur = 0;

        while ($resultat = mysqli_fetch_array($requete)) {
            $compteur++;
            $classe = ($compteur % 2 == 0) ? "even" : "odd";
            $cheminImage = "Resources/Images_voitures/" . $resultat["image"];

            echo "<tr class='" . $classe . "'>
                    <td><img class='img-voiture' src='" . $cheminImage . "' alt='Image du modèle'></td>
                    <td>" . $resultat["marque"] . "</td>
                    <td>" . $resultat["modele"] . "</td>
                    <td>" . $resultat["immatriculation"] . "</td>
                    <td>" . $resultat["compteur"] . " Km</td>
                    <td>
                        <a class='delete-button' href=../src/controlers/supprimer_vehicule.php?supprimer_vehicule=" . $resultat["id_voiture"] . "class='delete-button'>Supprimer</a><br><br>
                        <a class='delete-button' href=../src/controlers/modifier_vehicule.php?id_voiture=" . $resultat["id_voiture"] . ">Modifier</a>
                    </td>
                </tr>";               
        }

        echo "</table></div>";
        
        // Vérifier si un message de suppression a été défini
        if (isset($_SESSION['vehicule_supprime'])) {
            echo "<script>alert('Le véhicule a été supprimé avec succès.');</script>";
            unset($_SESSION['vehicule_supprime']);
        }
        ?>
    </main>

    <footer>
    </footer>
</body>
</html>