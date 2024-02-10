<?php include '../layouts/navbar.php'; ?>
<?php include '../../config/bdd.php'; ?>

<div class="container mt-5">
    <h2>Liste des Messages</h2>

    <?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM messages WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">Message supprimé avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur lors de la suppression du Message : ' . $conn->error . '</div>';
        }
    }

    $sql = "SELECT * FROM messages";
    $result = $conn->query($sql);

    ?>

    <table class="table mt-3 table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Description du Message</th>
                <th>Date du Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['description_message'] . "</td>";
                    echo "<td>" . $row['date_message'] . "</td>";
                    echo "<td>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-danger'>
                                <i class='fa fa-trash'></i> Supprimer
                            </a>    
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun Message trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../layouts/footer.php"); ?>
