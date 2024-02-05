<?php include '../layouts/navbar.php'; ?>
<?php include '../../config/bdd.php'; ?>

<div class="container mt-5 ms-auto">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row d-flex align-items-center">
            <div class="col-6"><input type="text" class="form-control" name="titre" id="" placeholder="Titre de la famille"></div>
            <div class="col-4"><input type="file" name="image" id="" class="form-control" placeholder="image famille"></div>
            <div class="col-2"><input type="submit" class="btn btn-outline-primary" value="Ajouter Famille"></div>
        </div>
    </form>

    <?php
    // Traitement de l'ajout de nouvelle famille
    if (isset($_POST['titre'])) {
        $titre = $_POST['titre'];

        // Traitement de l'upload de l'image (remplacez ce chemin par le vôtre)
        $image_path =$_SERVER['DOCUMENT_ROOT']. "/eng/assets/img/"; // Chemin où vous souhaitez enregistrer les images
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp_name, $image_path . $image_name);

        // Insérer les données dans la base de données
        $sql = "INSERT INTO familles (titre_famille, image_famille) VALUES ('$titre', '$image_name')";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">Famille ajoutée avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur lors de l\'ajout de la famille : ' . $conn->error . '</div>';
        }
    }

    // Traitement de la suppression de famille
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        // Supprimer la famille de la base de données
        $sql = "DELETE FROM familles WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">Famille supprimée avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur lors de la suppression de la famille : ' . $conn->error . '</div>';
        }
    }

    // Récupérer les familles depuis la base de données
    $sql = "SELECT * FROM familles";
    $result = $conn->query($sql);

    ?>

    <table class="table mt-3 table-bordered table-striped">
        <thead>
            <th>Titre Famille</th>
            <th>Image famille</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['titre_famille'] . "</td>";
                    echo "<td><img src='/eng/assets/img/" . $row['image_famille'] . "' width='100'></td>";
                    echo "<td>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-outline-danger'>
                                <i class='fa fa-trash'></i>
                            </a>    
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucune famille trouvée.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../layouts/footer.php"); ?>
