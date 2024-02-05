<?php
session_start();

if (isset($_SESSION['username_admin'])) {
    header('location: index.php');
    exit();
}
?>

<head>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <script src="/eng/assets/js/bootstrap.min.js"></script>
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Connexion Administrateur</div>
                <div class="card-body">
                    <?php
                    include '../config/bdd.php';

                    // Vérifier la soumission du formulaire
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Récupérer les données d'entrée
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        // Valider les identifiants (utilisez des méthodes plus sécurisées)
                        $sql = "SELECT * FROM admin WHERE email_admin = '$email' AND mp_admin = '$password'";
                        $result = $conn->query($sql);

                        if ($result->num_rows == 1) {
                            // Connexion réussie
                            $adminData = $result->fetch_assoc();
                            $_SESSION['username_admin'] = $adminData['username_admin'];
                            header('location: index.php');
                            exit();
                        } else {
                            // Identifiants invalides
                            echo "<div class='alert alert-danger'>Email ou mot de passe incorrect !</div>";
                        }

                        // Fermer la connexion à la base de données
                        $conn->close();
                    }
                    ?>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group mb-3">
                            <label for="email">Email :</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>