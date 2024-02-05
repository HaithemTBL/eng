<?php
session_start();
if (!isset($_SESSION['username_admin'])) {
    header("location: /eng/admin/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | ADMIN</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="/eng/assets/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg " style="background-color: #3E3E3E;">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="/eng/assets/img/logo.png" height="78" srcset=""></a><span class="text-white text-center"> ENTREPRISE NATIONALE DES GRANULATS <br>المؤسسة الوطنية للحصى</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/eng/admin/" style="color:white;">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/famille" style="color:white;">Famille</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/produit" style="color:white;">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/client" style="color:white;">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/devis" style="color:white;">Devis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/categories" style="color:white;">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/caracteristiques" style="color:white;">caracteristiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eng/admin/contact" style="color:white;">Contacts</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white;">
                            <?php echo $_SESSION['username_admin']; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- You may include additional dropdown items here -->
                            <a class="dropdown-item" href="/eng/admin/logout.php">
                                Deconnexion
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->