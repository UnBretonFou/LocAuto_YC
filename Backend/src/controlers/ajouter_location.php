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

    //Vérifier la disponnibilité de la voiture
    $sql_disponibilite = "SELECT COUNT(*) AS count
                          FROM location
                          WHERE id_voiture = '$voiture'
                          AND (date_debut <= '$date_debut' AND date_fin >= '$date_debut')
                          OR (date_debut <= '$date_fin' AND date_fin >= '$date_fin')
                          OR ('$date_debut' <= date_debut AND '$date_fin' >= date_debut)";
    $result_disponibilite = mysqli_query($con, $sql_disponibilite);
    $row_disponibilite = mysqli_fetch_array($result_disponibilite);
    $count_disponibilite = $row_disponibilite["count"];

    if ($count_disponibilite > 0) {
        // La voiture n'est pas disponible pendant la période spécifiée
        // Afficher un message d'erreur ou prendre une action appropriée
        // Par exemple :
        echo "La voiture n'est pas disponible pendant la période spécifiée.";
        // Vous pouvez rediriger vers une autre page ou afficher un message d'erreur dans le formulaire
        // Assurez-vous d'adapter cette action en fonction de vos besoins.
        exit();
    }

     // La voiture est disponible, procéder à l'insertion
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