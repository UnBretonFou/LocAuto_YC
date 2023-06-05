<?php
session_start();
include "../../outils/biblio.php";
    $con = connexion();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $clientNom = $_POST["client_nom"];

    //Supprimer les enregistrements liés dans la table `location`
    $sql = "DELETE FROM location WHERE id_client IN (SELECT id_client FROM client WHERE nom = '$clientNom')";
    $result = mysqli_query($con, $sql);

    //Supprimer le client
    $sql = "DELETE FROM client WHERE nom = '$clientNom'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["message"] = "Le client a été supprimé avec succès.";
    } else {
        $_SESSION["error"] = "Une erreur s'est produite lors de la suppression du client.";
    }
}

    echo "<script>alert('Le client a été supprimé avec succès.'); window.location.href = '../client.php';</script>";
    
?>
