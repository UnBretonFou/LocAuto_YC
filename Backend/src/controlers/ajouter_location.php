<?php
    session_start();
    include "../../outils/biblio.php";
    $con = connexion();

    // Récupérer les données du formulaire
    $voiture_modele = $_POST["voiture_modele"];
    $client = $_POST["client"];
    $compteur_debut = $_POST["compteur_debut"];
    $compteur_fin = $_POST["compteur_fin"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $choix_option = $_POST["choix_option"];

    //Récupérer l'id_modele de voiture en fonction du libellé
    $sql_voiture_modele = "SELECT id_modele FROM modele";
    $result_voiture_modele = mysqli_query($con, $sql_voiture_modele);
    $row_voiture_modele = mysqli_fetch_array($result_voiture_modele);
    $id_voiture = $row_voiture_modele["id_modele"];

    //Récupérer l'id du client en fonction du nom
    $sql_client = "SELECT id_client FROM client WHERE nom = '$client'";
    $result_client = mysqli_query($con, $sql_client); 
    $row_client = mysqli_fetch_array($result_client);
    $id_client = $row_client["id_client"];

    //Insérer la nouvelle location dans la base de données
    $sql = "INSERT INTO location (id_client, id_voiture, compteur_debut, compteur_fin, date_debut, date_fin)
            VALUES ('$id_client', '$id_voiture', '$compteur_debut', '$compteur_fin', '$date_debut', '$date_fin')";
    mysqli_query($con, $sql);

    // Rediriger vers la page principale
    header("Location: ../facturation.php");
    exit();

?>