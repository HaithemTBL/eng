<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | Accueil</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/eng/assets/css/style.css">
    <script src="/eng/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include 'config/bdd.php';
    require('fpdf/fpdf.php');

    // Vérifie si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupère les données du formulaire
        $nomClient = mysqli_real_escape_string($conn, $_POST['nomClient']);
        $prenomClient = mysqli_real_escape_string($conn, $_POST['prenomClient']);
        $emailClient = mysqli_real_escape_string($conn, $_POST['emailClient']);
        $telClient = mysqli_real_escape_string($conn, $_POST['telClient']);
        $adresseClient = mysqli_real_escape_string($conn, $_POST['adresseClient']);
        $categorieClient = mysqli_real_escape_string($conn, $_POST['categorieClient']);

        // Insertion dans la table client
        $insertClientQuery = "INSERT INTO client (nom_client, prenom_client, email_client, tel_client, adresse_client, id_cat) 
                              VALUES ('$nomClient', '$prenomClient', '$emailClient', '$telClient', '$adresseClient', '$categorieClient')";

        if ($conn->query($insertClientQuery) === TRUE) {
            $clientId = $conn->insert_id;

            // Insertion dans la table devis
            $insertDevisQuery = "INSERT INTO devis (date_devis, id_client) VALUES (NOW(), '$clientId')";

            if ($conn->query($insertDevisQuery) === TRUE) {
                $devisId = $conn->insert_id;

                // Insertion dans la table avoir1
                $idProduit = mysqli_real_escape_string($conn, $_POST['productID']);
                $quantite = mysqli_real_escape_string($conn, $_POST['quantite']);
                // $nom_produit = "SELECT nom_produit FROM produits WHERE id=$idProduit";

                // Exécution de la requête SQL pour récupérer le nom du produit
                $nom_produit_query = "SELECT nom_produit FROM produits WHERE id=$idProduit";
                $result = $conn->query($nom_produit_query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $nom_produit = $row['nom_produit'];
                        // Utilisez $nom_produit comme vous le souhaitez
                    }
                } else {
                    echo "<div class='alert alert-warning'>Aucun produit trouvé avec l'ID spécifié</div>";
                }


                $insertAvoirQuery = "INSERT INTO avoir1 (id_produit, id_devis, quantite) 
                        VALUES ('$idProduit', '$devisId', '$quantite')";

                if ($conn->query($insertAvoirQuery) === FALSE) {
                    echo "<div class='alert alert-danger'>Erreur lors de l'insertion dans la table avoir1 : " . $conn->error . "</div>";
                    exit();
                }

                echo "<div class='container text-center mt-5'>";
                echo "<h2 class='text-success'>Devis enregistré avec succès</h2>";
                echo "<img src='/eng/assets/img/envelope.png' alt='Success Illustration' class='img-fluid mt-3' />";
                echo "<p>Nous vous contacterons dans les plus brefs délais.</p>";
                echo "</div>";
                // Génère le PDF
                $pdf = new FPDF();
                $pdf->AddPage();

                // Header avec le nom de l'entreprise
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 10, utf8_decode('ENTREPRISE NATIONALE DES GRANULATS'), 0, 1, 'C');
                $pdf->Ln(5);
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Ln(10);

                // Styling
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(65, 105, 225); // Couleur de fond
                $pdf->SetTextColor(255, 255, 255); // Couleur du texte
                $pdf->Cell(0, 10, 'Devis Information', 0, 1, 'C', true); // Titre centré avec couleur de fond

                $pdf->SetFont('Arial', '', 12);
                $pdf->SetFillColor(255, 255, 255); // Couleur de fond blanche
                $pdf->SetTextColor(0, 0, 0); // Couleur du texte noir

                // Détails du client dans un tableau
                $pdf->Cell(60, 10, 'Nom du client:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($nomClient), 1, 1);

                $pdf->Cell(60, 10, 'Prenom du client:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($prenomClient), 1, 1);

                $pdf->Cell(60, 10, 'Email du client:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($emailClient), 1, 1);

                $pdf->Cell(60, 10, 'Telphone du client:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($telClient), 1, 1);

                $pdf->Cell(60, 10, 'Adresse du client:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($adresseClient), 1, 1);

                $pdf->Cell(60, 10, 'Produit:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($nom_produit), 1, 1);

                $pdf->Cell(60, 10, 'Quantite:', 1, 0, 'L', true);
                $pdf->Cell(0, 10, utf8_decode($quantite), 1, 1);

                $pdfFilePath = 'assets/devis/' . 'devis_' . $clientId . '.pdf';
                $pdfDirectory = dirname($pdfFilePath);

                if (!is_dir($pdfDirectory)) {
                    mkdir($pdfDirectory, 0777, true);
                }

                // Sauvegarde le PDF dans un fichier
                $pdf->Output($pdfFilePath, 'F');

                echo "<p class='text-center'>PDF généré avec succès. <a href='$pdfFilePath' download>Télécharger le PDF</a></p>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'enregistrement du devis : " . $conn->error . "</div>";
            }
        }
    }
    ?>
</body>

</html>