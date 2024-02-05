<?php
include 'config/bdd.php';

// Récupérer les produits depuis la base de données
$sqlProduits = "SELECT * FROM produits";
$resultProduits = $conn->query($sqlProduits);

// Récupérer les familles depuis la base de données
$sqlFamilles = "SELECT * FROM familles";
$resultFamilles = $conn->query($sqlFamilles);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | ADMIN</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/eng/assets/css/style.css"> <!-- Ajoutez un fichier CSS pour personnaliser le style -->
    <script src="/eng/assets/js/bootstrap.min.js"></script>
</head>
<body>

<!-- start navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/eng/assets/img/logo.png" height="78" alt="Logo"></a>
        <span class="navbar-text">
            ENTREPRISE NATIONALE DES GRANULATS
            <br>
            المؤسسة الوطنية للحصى
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/eng/admin/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/famille">Famille</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/produit">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/client">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/devis">Devis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/caracteristiques">Caracteristiques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/eng/admin/contact">Contacts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar -->

<!-- Hero Section -->
<header class="hero bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Bienvenue dans notre entreprise</h1>
        <p class="lead">Découvrez nos produits de haute qualité et notre service exceptionnel.</p>
        <a href="#products" class="btn btn-light btn-lg">Voir les produits</a>
    </div>
</header>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <h2 class="text-center">Nos Produits</h2>
        <div class="row">
            <?php
            if ($resultProduits->num_rows > 0) {
                while ($rowProduit = $resultProduits->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    if (!empty($rowProduit['url_img'])) {
                        echo "<img src='/eng/assets/img/" . $rowProduit['url_img'] . "' alt='Image du produit' class='card-img-top w-50'>";
                    }
                    echo "<div class='card-body'>";
                    echo "<h4 class='card-title'>" . $rowProduit['nom_produit'] . "</h4>";
                    echo "<p class='card-text'>" . $rowProduit['description_produit'] . "</p>";
                    echo "<p class='card-text'>Prix : $" . $rowProduit['prix_produit'] . "</p>";
                    echo "</div></div></div>";
                }
            } else {
                echo "Aucun produit trouvé.";
            }
            ?>
        </div>
    </div>
</section>

<!-- Families Section with Filter -->
<section id="families" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Familles de Produits</h2>
        <div class="row">
            <?php
            if ($resultFamilles->num_rows > 0) {
                while ($rowFamille = $resultFamilles->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    if (!empty($rowFamille['image_famille'])) {
                        echo "<img src='/eng/assets/img/" . $rowFamille['image_famille'] . "' alt='Image de la famille' class='card-img-top'>";
                    }
                    echo "<div class='card-body'>";
                    echo "<h4 class='card-title'>" . $rowFamille['titre_famille'] . "</h4>";
                    echo "</div></div></div>";
                }
            } else {
                echo "Aucune famille trouvée.";
            }
            ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <h2 class="text-center">Contactez-nous</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse e-mail">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Votre message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- À propos de nous Section -->
<section id="about" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">À propos de nous</h2>
        <p class="text-center">Nous sommes une entreprise spécialisée dans la production de granulats de haute qualité depuis plus de 20 ans.</p>
        <p class="text-center">Notre mission est de fournir des produits de qualité supérieure à nos clients tout en respectant les normes environnementales les plus strictes.</p>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-3">
    <div class="container text-center">
        <p>Suivez-nous sur les réseaux sociaux :</p>
        <a href="#" class="btn btn-outline-light mx-2"><i class="fab fa-facebook"></i></a>
        <a href="#" class="btn btn-outline-light mx-2"><i class="fab fa-twitter"></i></a>
        <a href="#" class="btn btn-outline-light mx-2"><i class="fab fa-instagram"></i></a>
        <p>Contactez-nous : contact@example.com</p>
        <p>Droit d'auteur © 2024 Entreprise Nationale des Granulats</p>
    </div>
</footer>

</body>
</html>
