<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
?>

<?php
// Inclure le fichier de connexion à la base de données
include "C:\xampp\htdocs\src\LocAuto_YC\Backend\outils\biblio.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $immatriculation = $_POST["immatriculation"];

    // Connexion à la base de données
    $con = connexion();

    // Préparer la requête d'insertion
    $sql = "INSERT INTO vehicules (marque, modele, immatriculation) VALUES ('$marque', '$modele', '$immatriculation')";

    // Exécuter la requête
    if (mysqli_query($con, $sql)) {
        echo "Le véhicule a été créé avec succès.";
    } else {
        echo "Erreur lors de la création du véhicule: " . mysqli_error($con);
    }

    // Fermer la connexion à la base de données
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un véhicule</title>
</head>
<body>
    <h1>Créer un véhicule</h1>
    <form method="POST" action="">
        <input type="text" name="marque" placeholder="Marque" required>
        <input type="text" name="modele" placeholder="Modèle" required>
        <input type="text" name="immatriculation" placeholder="Immatriculation" required>
        <input type="submit" name="creer" value="Créer">
    </form>
</body>
</html>
