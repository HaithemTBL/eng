<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

// Traitement de la suppression d'un produit
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete_produit = "DELETE FROM produits WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_produit);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Produit supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression du produit : ' . $conn->error . '</div>';
    }
}

// Traitement de l'édition d'un produit (à implémenter)

// Récupérer tous les produits
$sql_produits = "SELECT * FROM produits";
$result_produits = $conn->query($sql_produits);

// Traitement de l'ajout d'un nouveau produit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_produit = htmlspecialchars($_POST['nom_produit']);
    $date_produit = $_POST['date_produit'];
    $description_produit = htmlspecialchars($_POST['description_produit']);
    $prix_produit = floatval($_POST['prix_produit']);
    $caracteristique = $_POST['caracteristique'];
    $id_famille = $_POST['famille'];

    // Traitement de l'upload de l'image
    $image_path = $_SERVER['DOCUMENT_ROOT'] . "/eng/assets/img/"; // Chemin où vous souhaitez enregistrer les images

    if (isset($_FILES['image_produit']) && $_FILES['image_produit']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image_produit']['name']);
        $image_tmp_name = $_FILES['image_produit']['tmp_name'];

        if (move_uploaded_file($image_tmp_name, $image_path . $image_name)) {
            // L'image a été téléchargée avec succès, vous pouvez maintenant insérer les données dans la table produits
            $sql = "INSERT INTO produits (nom_produit, date_produit, description_produit, url_img, prix_produit, id_famille) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssdi", $nom_produit, $date_produit, $description_produit, $image_name, $prix_produit, $id_famille);

            if ($stmt->execute()) {
                $id_produit = $stmt->insert_id; // Récupérer l'ID du produit inséré

                // Insérer les données dans la table avoir2 pour chaque caractéristique sélectionnée
                foreach ($caracteristique as $id_carac) {
                    $sql_avoir2 = "INSERT INTO avoir2 (id_produit, id_carac) VALUES (?, ?)";
                    $stmt_avoir2 = $conn->prepare($sql_avoir2);
                    $stmt_avoir2->bind_param("ii", $id_produit, $id_carac);

                    if ($stmt_avoir2->execute()) {
                        // Vous pouvez ajouter ici un message de succès si nécessaire
                    } else {
                        echo '<div class="alert alert-danger">Erreur lors de l\'insertion dans la table avoir2 : ' . $conn->error . '</div>';
                    }
                }

                echo '<div class="alert alert-success">Produit ajouté avec succès.</div>';
                // Rediriger vers la même page pour actualiser
                header("Location: index.php");
                exit(); // Assurez-vous de quitter le script après la redirection
            } else {
                echo '<div class="alert alert-danger">Erreur lors de l\'ajout du produit : ' . $conn->error . '</div>';
            }
        }
    }
}

// Récupérer les caractéristiques depuis la table caracteristiques
$sql_caracteristiques = "SELECT * FROM caracteristiques";
$result_caracteristiques = $conn->query($sql_caracteristiques);
$sql_famille = "SELECT * FROM familles";
$result_famille = $conn->query($sql_famille);



// Récupérer les données du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['produit_id_modif'])) {
    $produit_id_modif = $_POST['produit_id_modif'];
    $nom_produit_modif = htmlspecialchars($_POST['nom_produit_modif']);
    $description_produit_modif = htmlspecialchars($_POST['description_produit_modif']);
    $prix_produit_modif = floatval($_POST['prix_produit_modif']);
    $caracteristique_modif = $_POST['caracteristique_modif']; // Les nouvelles caractéristiques sélectionnées

    // Supprimer les entrées existantes dans la table avoir2 pour ce produit
    $sql_delete_avoir2 = "DELETE FROM avoir2 WHERE id_produit = ?";
    $stmt_delete_avoir2 = $conn->prepare($sql_delete_avoir2);
    $stmt_delete_avoir2->bind_param("i", $produit_id_modif);

    if ($stmt_delete_avoir2->execute()) {
        // Les entrées de la table avoir2 ont été supprimées avec succès

        // Mettre à jour les données du produit dans la table produits
        $sql_update_produit = "UPDATE produits SET nom_produit = ?, description_produit = ?, prix_produit = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update_produit);
        $stmt_update->bind_param("ssdi", $nom_produit_modif, $description_produit_modif, $prix_produit_modif, $produit_id_modif);

        if ($stmt_update->execute()) {
            // Le produit a été modifié avec succès

            // Ajouter les nouvelles caractéristiques sélectionnées dans la table avoir2
            foreach ($caracteristique_modif as $id_carac) {
                $sql_insert_avoir2 = "INSERT INTO avoir2 (id_produit, id_carac) VALUES (?, ?)";
                $stmt_insert_avoir2 = $conn->prepare($sql_insert_avoir2);
                $stmt_insert_avoir2->bind_param("ii", $produit_id_modif, $id_carac);

                if ($stmt_insert_avoir2->execute()) {
                    // Caractéristique ajoutée avec succès
                } else {
                    echo '<div class="alert alert-danger">Erreur lors de l\'insertion dans la table avoir2 : ' . $conn->error . '</div>';
                }
            }

            echo '<div class="alert alert-success">Produit modifié avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur lors de la modification du produit : ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression des caractéristiques existantes : ' . $conn->error . '</div>';
    }
}

?>
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterProduitModal">
        Ajouter un Produit
    </button>

    <!-- Tableau pour afficher les produits -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom du Produit</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_produits->num_rows > 0) {
                while ($row_produit = $result_produits->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_produit['nom_produit'] . "</td>";
                    echo "<td>" . $row_produit['description_produit'] . "</td>";
                    echo "<td>" . $row_produit['prix_produit'] . "</td>";
                    echo "<td>
                    <button class='btn btn-info edit-button' data-bs-toggle='modal' data-bs-target='#modifierProduitModal' data-backdrop='static' data-id='" . $row_produit['id'] . "' data-nom='" . $row_produit['nom_produit'] . "' data-description='" . $row_produit['description_produit'] . "' data-prix='" . $row_produit['prix_produit'] . "'><i class='fa fa-edit'></i></button>

                            <a href='index.php?delete_id=" . $row_produit['id'] . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun produit trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Modal pour l'ajout de produit -->
<div class="modal fade" id="ajouterProduitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="container p-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- <div class="col-6"> -->
                        <div class="form-group mb-2">
                            <label for="nom_produit">Nom du Produit</label>
                            <input type="text" class="form-control" name="nom_produit" id="nom_produit" placeholder="Nom du produit" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="date_produit">Date du Produit</label>
                            <input type="date" class="form-control" name="date_produit" id="date_produit" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description_produit">Description du Produit</label>
                            <textarea class="form-control" name="description_produit" id="description_produit" rows="4" placeholder="Description du produit" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="image_produit">Uploader une image</label>
                            <input type="file" class="form-control" name="image_produit" id="image_produit" accept="image/*" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="prix_produit">Prix du Produit</label>
                            <input type="number" class="form-control" name="prix_produit" id="prix_produit" placeholder="Prix du produit" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="famille">Famille</label>
                            <select class="form-control" name="famille" id="famille" required>
                                <?php
                                if ($result_famille->num_rows > 0) {
                                    while ($row_famille = $result_famille->fetch_assoc()) {
                                        echo "<option value='" . $row_famille['id'] . "'>" . $row_famille['titre_famille'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="caracteristique">Caractéristiques</label>
                            <select multiple class="form-control" name="caracteristique[]" id="caracteristique" required>
                                <?php
                                if ($result_caracteristiques->num_rows > 0) {
                                    while ($row_caracteristique = $result_caracteristiques->fetch_assoc()) {
                                        echo "<option value='" . $row_caracteristique['id'] . "'>" . $row_caracteristique['libelle_carac'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" class="btn btn-outline-primary" value="Ajouter Produit">
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la modification de produit -->
<div class="modal fade" id="modifierProduitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Formulaire de modification -->
            <!-- Formulaire de modification -->
            <form action="edit_produit.php" method="post">
                <!-- Contenu du formulaire de modification -->
                <div class="modal-body">
                    <!-- Champ caché pour stocker l'ID du produit à modifier -->
                    <input type="hidden" id="produit_id_modif" name="produit_id_modif">

                    <div class="form-group mb-2">
                        <label for="nom_produit_modif">Nom du Produit</label>
                        <input type="text" class="form-control" name="nom_produit_modif" id="nom_produit_modif" placeholder="Nom du produit" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="description_produit_modif">Description du Produit</label>
                        <textarea class="form-control" name="description_produit_modif" id="description_produit_modif" rows="4" placeholder="Description du produit" required></textarea>
                    </div>

                    <div class="form-group mb-2">
                        <label for="prix_produit_modif">Prix du Produit</label>
                        <input type="number" class="form-control" name="prix_produit_modif" id="prix_produit_modif" placeholder="Prix du produit" required>
                    </div>

                    <!-- Ajoutez d'autres champs de modification ici (famille, caractéristiques, etc.) -->
                    <!-- Exemple de champ pour la famille -->
                    <div class="form-group mb-2">
                        <label for="famille_modif">Famille</label>
                        <select class="form-control" name="famille_modif" id="famille_modif" required>
                            <?php
                            // Utilisez la variable $row_produit pour récupérer la famille du produit à modifier
                            // Assurez-vous que $row_produit contient les données du produit lors de l'édition
                            // Utilisez une boucle pour afficher toutes les options de famille
                            while ($row_famille = $result_famille->fetch_assoc()) {
                                echo "<option value='" . $row_famille['id'] . "'>" . $row_famille['titre_famille'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Exemple de champ pour les caractéristiques -->
                    <div class="form-group mb-2">
                        <label for="caracteristique_modif">Caractéristiques</label>
                        <select multiple class="form-control" name="caracteristique_modif[]" id="caracteristique_modif" required>
                            <?php
                            // Utilisez la variable $row_produit pour récupérer les caractéristiques du produit à modifier
                            // Assurez-vous que $row_produit contient les données du produit lors de l'édition
                            // Utilisez une boucle pour afficher toutes les options de caractéristiques
                            while ($row_caracteristique = $result_caracteristiques->fetch_assoc()) {
                                echo "<option value='" . $row_caracteristique['id'] . "'>" . $row_caracteristique['libelle_carac'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Enregistrer les modifications">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".edit-button").click(function() {
            var id = $(this).data("id");
            var nom = $(this).data("nom");
            var description = $(this).data("description");
            var prix = $(this).data("prix");

            // Remplir les champs du formulaire avec les données du produit
            $("#produit_id_modif").val(id);
            $("#nom_produit_modif").val(nom);
            $("#description_produit_modif").val(description);
            $("#prix_produit_modif").val(prix);

            // Ouvrir le modal de modification
            $("#modifierProduitModal").modal("show");
        });
    });
</script>


<?php include("../layouts/footer.php"); ?>