<?php
    session_start();
    include "../../outils/biblio.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //On récupère ici les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $id_type_client = $_POST["type_client"];

        //On se connecte maintenant à la base de données
        $con = connexion();

        //Requête SQL d'insertion
        $sql = "INSERT INTO client (nom, prenom, adresse, id_type_de_client) VALUES ('$nom', '$prenom', '$adresse', '$id_type_client')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            //Succès de la requête
            echo "<script>alert('Le client a été ajouté avec succès.'); window.location.href = '../client.php';</script>";
        } else {
            //Si échec de la requête
            echo "<script>alert('Une erreur s'est produite lors de l'ajout du client.'); window.location.href = '../client.php';</script>";
            // $_SESSION["error"] = "Une erreur s'est produite lors de l'ajout du client.";  -- Code précédent
        }
    }

?>