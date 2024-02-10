<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

// Traitement de l'ajout d'une nouvelle catégorie
if (isset($_POST['nom_cat'])) {
    $nom_cat = $_POST['nom_cat'];

    // Insérer les données dans la table categories
    $sql = "INSERT INTO categories (nom_cat) VALUES ('$nom_cat')";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Catégorie ajoutée avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de l\'ajout de la catégorie : ' . $conn->error . '</div>';
    }
}
// Traitement de la suppression d'un client
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete_client = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_client);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">categories supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression du categories : ' . $conn->error . '</div>';
    }
}
// Récupérer les catégories depuis la table categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

?>

<div class="container mt-5 ms-auto">
    <form action="" method="post">
        <div class="row d-flex align-items-center">
            <div class="col-6"><input type="text" class="form-control" name="nom_cat" id="" placeholder="Nom de la catégorie"></div>
            <div class="col-2"><input type="submit" class="btn btn-outline-primary" value="Ajouter Catégorie"></div>
        </div>
    </form>

    <table class="table mt-3 table-bordered table-striped">
        <thead>
            <th>Nom de la catégorie</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nom_cat'] . "</td>";
                    echo "<td>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-outline-danger'>
                                <i class='fa fa-trash'></i>
                            </a>    
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Aucune catégorie trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../layouts/footer.php"); ?>
