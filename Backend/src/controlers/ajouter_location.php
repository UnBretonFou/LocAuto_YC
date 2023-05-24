<?php
    session_start();
    include "../../outils/biblio.php";
    $con = connexion();

    // Récupérer les données du formulaire
    $voiture = $_POST["voiture"];
    $client = $_POST["client"];
    $compteur_debut = $_POST["compteur_debut"];
    $compteur_fin = $_POST["compteur_fin"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $choix_option = $_POST["choix_option"];


    //Insérer la nouvelle location dans la base de données
    $sql = "INSERT INTO location (id_client, id_voiture, compteur_debut, compteur_fin, date_debut, date_fin)
            VALUES ('$client', '$voiture', '$compteur_debut', '$compteur_fin', '$date_debut', '$date_fin')";
    mysqli_query($con, $sql);

    // Récupérer l'ID de la dernière insertion
    $id_location = mysqli_insert_id($con);

    // Insérer les choix d'options pour la nouvelle location
    foreach ($choix_option as $id_option) {
        // Insérer une nouvelle entrée dans la table choix_option
        $sql_insert_option = "INSERT INTO choix_option (id_location, id_option) VALUES ('$id_location', '$id_option')";
        mysqli_query($con, $sql_insert_option);
    }

    // Rediriger vers la page principale
    header("Location: ../location.php");
    exit();
?>