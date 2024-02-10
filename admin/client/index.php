<?php
include '../layouts/navbar.php';
include '../../config/bdd.php';

// Traitement de la suppression d'un client
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete_client = "DELETE FROM client WHERE id_client = ?";
    $stmt = $conn->prepare($sql_delete_client);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Client supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression du client : ' . $conn->error . '</div>';
    }
}

// Traitement de l'édition d'un client (à implémenter)

// Récupérer tous les clients
$sql_clients = "SELECT * FROM client";
$result_clients = $conn->query($sql_clients);

// Traitement de l'ajout d'un nouveau client
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $prenom_client = htmlspecialchars($_POST['prenom_client']);
    $email_client = htmlspecialchars($_POST['email_client']);
    $tel_client = $_POST['tel_client'];
    $adresse_client = htmlspecialchars($_POST['adresse_client']);
    $categorie_client = htmlspecialchars($_POST['categorie_client']);

    $sql = "INSERT INTO client (nom_client, prenom_client, email_client, tel_client, adresse_client, id_cat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nom_client, $prenom_client, $email_client, $tel_client, $adresse_client, $categorie_client);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Client ajouté avec succès.</div>';
        // Rediriger vers la même page pour actualiser
        header("Location: index.php");
        exit(); // Assurez-vous de quitter le script après la redirection
    } else {
        echo '<div class="alert alert-danger">Erreur lors de l\'ajout du client : ' . $conn->error . '</div>';
    }
}
?>

<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterClientModal">
        Ajouter un Client
    </button>

    <!-- Tableau pour afficher les clients -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Categorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_clients->num_rows > 0) {
                while ($row_client = $result_clients->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_client['nom_client'] . "</td>";
                    echo "<td>" . $row_client['prenom_client'] . "</td>";
                    echo "<td>" . $row_client['email_client'] . "</td>";
                    echo "<td>" . $row_client['tel_client'] . "</td>";
                    echo "<td>" . $row_client['adresse_client'] . "</td>";
                    $categorie_id = $row_client['id_cat'];
                    $sql_categorie = "SELECT nom_cat FROM categories WHERE id = ?";
                    $stmt_categorie = $conn->prepare($sql_categorie);
                    $stmt_categorie->bind_param("i", $categorie_id);
                    $stmt_categorie->execute();
                    $result_categorie = $stmt_categorie->get_result();
                    if ($row_categorie = $result_categorie->fetch_assoc()) {
                        $nom_categorie = $row_categorie['nom_cat'];
                        echo "<td>" . $nom_categorie . "</td>";
                    }
                    echo "<td>
                    <button class='btn btn-info edit-button' data-toggle='modal' data-target='#modifierClientModal' data-backdrop='static' data-id='" . $row_client['id_client'] . "' data-nom='" . $row_client['nom_client'] . "' data-prenom='" . $row_client['prenom_client'] . "' data-email='" . $row_client['email_client'] . "' data-tel='" . $row_client['tel_client'] . "' data-adresse='" . $row_client['adresse_client'] . "'><i class='fa fa-edit'></i></button>

                            <a href='index.php?delete_id=" . $row_client['id_client'] . "' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun client trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal pour l'ajout de client -->
<div class="modal fade" id="ajouterClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="container p-5">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="nom_client">Nom du Client</label>
                            <input type="text" class="form-control" name="nom_client" id="nom_client" placeholder="Nom du client" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="prenom_client">Prénom du Client</label>
                            <input type="text" class="form-control" name="prenom_client" id="prenom_client" placeholder="Prénom du client" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email_client">Email du Client</label>
                            <input type="email" class="form-control" name="email_client" id="email_client" placeholder="Email du client" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="tel_client">Téléphone du Client</label>
                            <input type="text" class="form-control" name="tel_client" id="tel_client" placeholder="Téléphone du client">
                        </div>
                        <div class="form-group mb-2">
                            <label for="adresse_client">Adresse du Client</label>
                            <textarea class="form-control" name="adresse_client" id="adresse_client" rows="4" placeholder="Adresse du client" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="categorie_client">Catégorie de Client</label>
                            <select class="form-control" name="categorie_client" id="categorie_client" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <?php
                                // Récupérer les catégories de la table "categories"
                                $sql_categories = "SELECT id, nom_cat FROM categories";
                                $result_categories = $conn->query($sql_categories);

                                if ($result_categories->num_rows > 0) {
                                    while ($row_categorie = $result_categories->fetch_assoc()) {
                                        echo "<option value='" . $row_categorie['id'] . "'>" . $row_categorie['nom_cat'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-outline-primary" value="Ajouter Client">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la modification de client -->
<div class="modal fade" id="modifierClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="edit_client.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="client_id_modif" name="client_id_modif">
                    <div class="form-group mb-2">
                        <label for="nom_client_modif">Nom du Client</label>
                        <input type="text" class="form-control" name="nom_client_modif" id="nom_client_modif" placeholder="Nom du client" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="prenom_client_modif">Prénom du Client</label>
                        <input type="text" class="form-control" name="prenom_client_modif" id="prenom_client_modif" placeholder="Prénom du client" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email_client_modif">Email du Client</label>
                        <input type="email" class="form-control" name="email_client_modif" id="email_client_modif" placeholder="Email du client" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tel_client_modif">Téléphone du Client</label>
                        <input type="text" class="form-control" name="tel_client_modif" id="tel_client_modif" placeholder="Téléphone du client">
                    </div>
                    <div class="form-group mb-2">
                        <label for="adresse_client_modif">Adresse du Client</label>
                        <textarea class="form-control" name="adresse_client_modif" id="adresse_client_modif" rows="4" placeholder="Adresse du client" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="categorie_client_modif">Catégorie de Client</label>
                        <select class="form-control" name="categorie_client_modif" id="categorie_client_modif" required>
                            <option value="">Sélectionnez une catégorie</option>
                            <?php
                            // Récupérer les catégories de la table "categories"
                            $sql_categories = "SELECT id, nom_cat FROM categories";
                            $result_categories = $conn->query($sql_categories);

                            if ($result_categories->num_rows > 0) {
                                while ($row_categorie = $result_categories->fetch_assoc()) {
                                    echo "<option value='" . $row_categorie['id'] . "'>" . $row_categorie['nom_cat'] . "</option>";
                                }
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".edit-button").click(function() {
            var id = $(this).data("id");
            var nom = $(this).data("nom");
            var prenom = $(this).data("prenom");
            var email = $(this).data("email");
            var tel = $(this).data("tel");
            var adresse = $(this).data("adresse");

            $("#client_id_modif").val(id);
            $("#nom_client_modif").val(nom);
            $("#prenom_client_modif").val(prenom);
            $("#email_client_modif").val(email);
            $("#tel_client_modif").val(tel);
            $("#adresse_client_modif").val(adresse);
        });
    });
</script>

<?php include("../layouts/footer.php"); ?>