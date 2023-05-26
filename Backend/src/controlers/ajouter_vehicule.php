<?php
session_start();
include "../../outils/biblio.php";
$con = connexion();
?>

<?php
// On récupère ici les données du formulaire
$id_marque = $_POST["id_marque"];
$id_modele = $_POST["id_modele"];
$immatriculation = $_POST["immatriculation"];
$compteur = $_POST["compteur"];

// Vérification de la duplication de la plaque d'immatriculation
$sql_check_immatriculation = "SELECT immatriculation FROM voiture WHERE immatriculation = '$immatriculation'";
$result_check_immatriculation = mysqli_query($con, $sql_check_immatriculation);

if (mysqli_num_rows($result_check_immatriculation) > 0) {
    // La plaque d'immatriculation existe déjà, afficher un message d'erreur
    echo "<script>alert('La plaque d\'immatriculation existe déjà. Veuillez choisir une autre plaque.'); window.location.href = '../recherche.php';</script>";
    exit();
} else {
    // La plaque d'immatriculation n'existe pas, procéder à l'insertion
    // Requête SQL pour insérer dans la table "voiture"
    $sql_voiture = "INSERT INTO voiture (immatriculation, compteur, id_modele) VALUES ('$immatriculation', '$compteur', '$id_modele')";
    $result_voiture = mysqli_query($con, $sql_voiture);

    if ($result_voiture) {
        // Récupère l'id de la dernière insertion dans la table "voiture"
        $id_voiture = mysqli_insert_id($con);

        // Requête SQL pour mettre à jour la voiture avec l'id du modèle
        $sql_update_voiture = "UPDATE voiture SET id_modele = '$id_modele' WHERE id_voiture = '$id_voiture'";
        $result_update_voiture = mysqli_query($con, $sql_update_voiture);


        //========================= Les requêtes qui me faisait bugger =========================\\
        //                                                                                      \\
        // // Requête SQL pour insérer dans la table "marque"                       //PAS BESOIN\\
        // $sql_marque = "INSERT INTO marque (id_marque) VALUES ('$id_marque')";    //PAS BESOIN\\
        // $result_marque = mysqli_query($con, $sql_marque);                        //PAS BESOIN\\
        //                                                                                      \\
        // // Requête SQL pour insérer dans la table "modele"                       //PAS BESOIN\\
        // $sql_modele = "INSERT INTO modele (id_modele) VALUES ('$id_modele')";    //PAS BESOIN\\
        // $result_modele = mysqli_query($con, $sql_modele);                        //PAS BESOIN\\
        //                                                                                      \\
        //========================= Les requêtes qui me faisait bugger =========================\\



        // Afficher un message de succès
        echo "<script>alert('Le véhicule a été ajouté avec succès.'); window.location.href = '../recherche.php';</script>";
        exit();
    } else {
        // Afficher un message d'erreur
        echo "<script>alert('Une erreur s\'est produite lors de l\'ajout du véhicule.'); window.location.href = '../client.php';</script>";
    }
}
?>