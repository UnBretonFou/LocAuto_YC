<!------------ AJOUTER VEHICULE ------------>
<?php
    session_start();
    include "../outils/biblio.php";
    $con = connexion(); 
    
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs du formulaire
        $marque = $_POST["marque"];
        $modele = $_POST["modele"];
        $immatriculation = $_POST["immatriculation"];
    
        // Vérifier la connexion
        if (!$con) {
            die("Échec de la connexion à la base de données : " . mysqli_connect_error());
        }
    
        // Préparer la requête d'insertion
        $sql = "INSERT INTO marque (id_marque, libelle) VALUES ('$id_marque', '$libelle')";
        $sql1 = "INSERT INTO modele (id_modele, libelle) VALUES ('$id_modele', '$libelle')";
        $sql = "INSERT INTO voiture (immatriculation) VALUES ('$immatriculation')";
    
        // Exécuter la requête
        if (mysqli_query($con, $sql)) {
            echo "Le véhicule a été créé avec succès.";
        } else {
            echo "Erreur lors de la création du véhicule : " . mysqli_error($conn);
        }
    }
    ?>
    