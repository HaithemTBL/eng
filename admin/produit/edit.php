<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
}

// Récupérer les données du produit à modifier
$sql_produits = "SELECT * FROM produits WHERE id='$edit_id'";
$result_produits = $conn->query($sql_produits);

// Récupérer les caractéristiques disponibles
$sql_caracteristiques = "SELECT * FROM caracteristiques";
$result_caracteristiques = $conn->query($sql_caracteristiques);

// Vérifier si le formulaire de modification est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['produit_id_modif'])) {
    $produit_id_modif = $_POST['produit_id_modif'];
    $nom_produit_modif = htmlspecialchars($_POST['nom_produit_modif']);
    $description_produit_modif = htmlspecialchars($_POST['description_produit_modif']);
    $prix_produit_modif = floatval($_POST['prix_produit_modif']);
    $caracteristique_modif = isset($_POST['caracteristique_modif']) ? $_POST['caracteristique_modif'] : [];

    // Supprimer les entrées existantes dans la table avoir2 pour ce produit
    $sql_delete_avoir2 = "DELETE FROM avoir2 WHERE id_produit = ?";
    $stmt_delete_avoir2 = $conn->prepare($sql_delete_avoir2);
    $stmt_delete_avoir2->bind_param("i", $produit_id_modif);
    $stmt_delete_avoir2->execute();

    // Mettre à jour les données du produit dans la table produits
    $sql_update_produit = "UPDATE produits SET nom_produit = ?, description_produit = ?, prix_produit = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update_produit);
    $stmt_update->bind_param("ssdi", $nom_produit_modif, $description_produit_modif, $prix_produit_modif, $produit_id_modif);
    $stmt_update->execute();

    // Ajouter les nouvelles caractéristiques sélectionnées dans la table avoir2
    foreach ($caracteristique_modif as $id_carac) {
        $sql_insert_avoir2 = "INSERT INTO avoir2 (id_produit, id_carac) VALUES (?, ?)";
        $stmt_insert_avoir2 = $conn->prepare($sql_insert_avoir2);
        $stmt_insert_avoir2->bind_param("ii", $produit_id_modif, $id_carac);
        $stmt_insert_avoir2->execute();
    }
    header("location: index.php");
    exit();
    echo '<div class="alert alert-success">Produit modifié avec succès.</div>';
}
?>

<div class="container">
    <form action="edit.php" method="post">
        <?php
        if ($result_produits->num_rows > 0) {
            while ($row_produit = $result_produits->fetch_assoc()) {
        ?>
                <input type="hidden" name="produit_id_modif" value="<?php echo $row_produit['id'] ?>">

                <div class="form-group">
                    <label for="nom_produit_modif">Nom du Produit</label>
                    <input type="text" class="form-control" name="nom_produit_modif" value="<?php echo $row_produit['nom_produit'] ?>" placeholder="Nom du produit" required>
                </div>

                <div class="form-group">
                    <label for="description_produit_modif">Description du Produit</label>
                    <textarea class="form-control" name="description_produit_modif" rows="4" placeholder="Description du produit" required><?php echo $row_produit['description_produit'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="prix_produit_modif">Prix du Produit</label>
                    <input type="number" class="form-control" name="prix_produit_modif" value="<?php echo $row_produit['prix_produit'] ?>" placeholder="Prix du produit" required>
                </div>

                <div class="form-group">
                    <label for="caracteristique_modif">Caractéristiques</label>
                    <select multiple class="form-control" name="caracteristique_modif[]" required>
                        <?php
                        while ($row_caracteristique = $result_caracteristiques->fetch_assoc()) {
                            // $selected = in_array($row_caracteristique['id'], $caracteristique_modif) ? 'selected' : '';
                            echo "<option value='" . $row_caracteristique['id'] . "' $selected>" . $row_caracteristique['libelle_carac'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
        <?php
            }
        } else {
            echo "<div class='alert alert-warning'>Aucun produit trouvé.</div>";
        }
        ?>

        <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <input type="submit" class="btn btn-primary ms-2" value="Enregistrer les modifications">
        </div>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>