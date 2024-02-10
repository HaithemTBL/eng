<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

require('../../fpdf/fpdf.php');

// Récupération des données pour afficher dans le tableau
$sql = "SELECT c.id_client, c.nom_client, c.prenom_client, c.tel_client, c.email_client, p.nom_produit, a.quantite
        FROM client c
        LEFT JOIN devis d ON c.id_client = d.id_client
        LEFT JOIN avoir1 a ON d.id_devis = a.id_devis
        LEFT JOIN produits p ON a.id_produit = p.id
        ORDER BY c.id_client";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Clients et Produits</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/eng/assets/css/style.css">
    <script src="/eng/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Tableau Clients et Produits</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Client</th>
                    <th>Nom Client</th>
                    <th>Prénom Client</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Nom Produit</th>
                    <th>Quantité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_client']}</td>";
                    echo "<td>{$row['nom_client']}</td>";
                    echo "<td>{$row['prenom_client']}</td>";
                    echo "<td>{$row['tel_client']}</td>";
                    echo "<td>{$row['email_client']}</td>";
                    echo "<td>{$row['nom_produit']}</td>";
                    echo "<td>{$row['quantite']}</td>";
                    echo "<td><a href='/eng/assets/devis/devis_" . $row['id_client'] . ".pdf' class='btn btn-primary' download>Télécharger Devis</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
