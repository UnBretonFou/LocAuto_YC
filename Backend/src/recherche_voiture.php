<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facturation</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/style_location.css">
</head>
<body>
    <header>
        <form method="POST" action="../src/controlers/ajouter_location.php">
            <h2>Ajouter un véhicule</h2>
            <label for="Marque :">Entrez la marque :</label>
            <select name="voiture_marque" required>
            </select><br>
            <label for="Modèle :">Entrez un modèle :</label>
                <select name="voiture_modele" requiered>
                <label for="Plaque :">Entrez la plaque :</label>
            <select name="voiture_plaque" required>
                <?php
                   // On récupère tous les noms des clients de la base de données
                    $sql = "SELECT v.immatriculation, m.libelle AS modele, ma.libelle AS marque
                    FROM voiture v
                    INNER JOIN modele m ON v.id_modele = m.id_modele
                    INNER JOIN marque ma ON v.id_marque = ma.id_marque";
                    $result = mysqli_query($conn, $sql);

                ?>
            </select>
            <input type="submit" value="Ajouter">
        </form>
    </header>

    <main>
    <h1>Notre parc de véhicules</h1>
        <?php
        // ici je vais mettre le tableau que j'avais fait avant 
            ?>

    </main>

    <footer>
    </footer>
</body>
</html>
