<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifications véhicules</title>
    <link rel="stylesheet" type="text/css" href="../src/Resources/Style/styles.css">
</head>
<body>
    <header>
  
    </header>

    <main>
        
        <h1></h1>

        <?php
        if (!$conn) {
            die("Échec de la connexion à la base de données : " . mysqli_connect_error());
        }
    
        // Créer un nouveau véhicule
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
            $immatriculation = $_POST["immatriculation"];
            $marque = $_POST["marque"];
            $modele = $_POST["modele"];
            $compteur = $_POST["compteur"];
    
            // Exécuter la requête d'insertion
            $sql = "INSERT INTO vehicules (immatriculation, marque, modele, compteur) VALUES ('$immatriculation', '$marque', '$modele', $compteur)";
            if (mysqli_query($conn, $sql)) {
                echo "Le véhicule a été créé avec succès.";
            } else {
                echo "Erreur lors de la création du véhicule : " . mysqli_error($conn);
            }
        }
    
        // Modifier un véhicule existant
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
            $id = $_POST["id"];
            $immatriculation = $_POST["immatriculation"];
            $marque = $_POST["marque"];
            $modele = $_POST["modele"];
            $compteur = $_POST["compteur"];
    
            // Exécuter la requête de mise à jour
            $sql = "UPDATE vehicules SET immatriculation = '$immatriculation', marque = '$marque', modele = '$modele', compteur = $compteur WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo "Le véhicule a été mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du véhicule : " . mysqli_error($conn);
            }
        }
    
        // Fermer la connexion à la base de données
        mysqli_close($conn);
    ?>

    <footer>
    </footer>
</body>
</html>
