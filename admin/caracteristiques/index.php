<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

// Traitement de l'ajout d'une nouvelle caractéristique
if (isset($_POST['libelle_carac'])) {
    $libelle_carac = $_POST['libelle_carac'];

    // Insérer les données dans la table caracteristiques
    $sql = "INSERT INTO caracteristiques (libelle_carac) VALUES ('$libelle_carac')";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Caractéristique ajoutée avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de l\'ajout de la caractéristique : ' . $conn->error . '</div>';
    }
}
// Traitement de la suppression d'un client
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete_client = "DELETE FROM caracteristiques WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_client);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">caracteristique supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression du caracteristique : ' . $conn->error . '</div>';
    }
}
// Récupérer les caractéristiques depuis la table caracteristiques
$sql = "SELECT * FROM caracteristiques";
$result = $conn->query($sql);

?>

<div class="container mt-5 ms-auto">
    <form action="" method="post">
        <div class="row d-flex align-items-center">
            <div class="col-6"><input type="text" class="form-control" name="libelle_carac" id="" placeholder="Libellé de la caractéristique"></div>
            <div class="col-2"><input type="submit" class="btn btn-outline-primary" value="Ajouter Caractéristique"></div>
        </div>
    </form>

    <table class="table mt-3 table-bordered table-striped">
        <thead>
            <th>Libellé de la caractéristique</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['libelle_carac'] . "</td>";
                    echo "<td>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-outline-danger'>
                                <i class='fa fa-trash'></i>
                            </a>    
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Aucune caractéristique trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../layouts/footer.php"); ?>
