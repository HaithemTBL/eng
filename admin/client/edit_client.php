<?php
include '../../config/bdd.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['client_id_modif'])) {
    $client_id_modif = $_POST['client_id_modif'];
    $nom_client_modif = htmlspecialchars($_POST['nom_client_modif']);
    $prenom_client_modif = htmlspecialchars($_POST['prenom_client_modif']);
    $email_client_modif = htmlspecialchars($_POST['email_client_modif']);
    $tel_client_modif = $_POST['tel_client_modif'];
    $adresse_client_modif = htmlspecialchars($_POST['adresse_client_modif']);
    $categorie_client_modif = htmlspecialchars($_POST['categorie_client_modif']);
    $client_id = $client_id_modif;
    $sql_update = "UPDATE client SET nom_client = ?, prenom_client = ?, email_client = ?, tel_client = ?, adresse_client = ?, id_cat = ? WHERE id_client = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssii", $nom_client_modif, $prenom_client_modif, $email_client_modif, $tel_client_modif, $adresse_client_modif, $categorie_client_modif, $client_id);

    // Exécutez la mise à jour
    if ($stmt_update->execute()) {
        echo '<div class="alert alert-success">Client mis à jour avec succès.</div>';
        // Rediriger vers la même page pour actualiser
        header("Location: index.php");
        exit(); // Assurez-vous de quitter le script après la redirection
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la mise à jour du client : ' . $conn->error . '</div>';
    }
}
