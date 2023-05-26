<?php
session_start();
include "../../outils/biblio.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère le nom du client à supprimer
    $clientNom = $_POST["client_nom"];

    // On se connecte à la base de données
    $con = connexion();

    // Supprimer les enregistrements liés dans la table `location`
    $sql = "DELETE FROM location WHERE id_client IN (SELECT id_client FROM client WHERE nom = '$clientNom')";
    $result = mysqli_query($con, $sql);

    // Requête SQL pour supprimer le client
    $sql = "DELETE FROM client WHERE nom = '$clientNom'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Succès de la requête
        $_SESSION["message"] = "Le client a été supprimé avec succès.";
    } else {
        // Si échec de la requête
        $_SESSION["error"] = "Une erreur s'est produite lors de la suppression du client.";
    }

    // // Redirection vers client.php après la suppression
    // header("Location: ../client.php");
    // exit();
}
    //Redirection vers client.php après la suppression
    echo "<script>alert('Le client a été supprimé avec succès.'); window.location.href = '../client.php';</script>";
?>
