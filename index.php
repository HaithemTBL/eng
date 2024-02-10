<?php
include 'config/bdd.php';

// Récupérer les produits depuis la base de données
$sqlProduits = "SELECT * FROM produits";
$resultProduits = $conn->query($sqlProduits);

// Récupérer les familles depuis la base de données
$sqlFamilles = "SELECT * FROM familles";
$resultFamilles = $conn->query($sqlFamilles);

$categoryQuery = "SELECT `id`, `nom_cat` FROM `categories`";
$categoryResult = mysqli_query($conn, $categoryQuery);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | Acceuil</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/eng/assets/css/style.css"> <!-- Ajoutez un fichier CSS pour personnaliser le style -->
    <script src="/eng/assets/js/bootstrap.min.js"></script>
    <style>
        /* Custom styles for the carousel */
        #productCarousel .carousel-item {
            height: 400px;
            /* Set a fixed height for the carousel items */
            overflow: hidden;
            /* Hide overflow content if images are larger */
        }

        #productCarousel img {
            object-fit: cover;
            /* Ensure the images cover the entire container */
            height: 100%;
            /* Make sure the image takes the full height of its container */
            width: 100%;
            /* Make sure the image takes the full width of its container */
        }

        /* Custom styles for product and family cards */
        .product-card,
        .family-card {
            height: 100%;
        }

        .product-card img,
        .family-card img {
            object-fit: cover;
            max-height: 200px;
            /* Set a maximum height for the images inside the cards */
            width: 100%;
        }
    </style>

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
                        <a class="nav-link" href="/eng/">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Catalogue de produits</a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php

                            while ($row = mysqli_fetch_assoc($resultFamilles)) {
                                echo '<a class="dropdown-item" href="/eng/products.php?family=' . $row['id'] . '">' . $row['titre_famille'] . '</a>';
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>A Propos</a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- You may include additional dropdown items here -->
                            <a class="dropdown-item" href="/eng/historique-eng.php">Historique ENG</a>
                            <a class="dropdown-item" href="/eng/organisation-entreprise.php">Organisation de l'entreprise</a>

                            <a class="dropdown-item" href="/eng/nos-missions.php">Nos missions</a>

                            <a class="dropdown-item" href="/eng/qualite.php">Qualité</a>
                            <a class="dropdown-item" href="/eng/conditions-vente.php">Conditions de vente</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/eng/contact.php">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->


    <div id="productCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php

            $firstItem = true; // To mark the first item as active
            while ($row = mysqli_fetch_assoc($resultProduits)) {
                // Use $row to get product details
                echo '<div class="carousel-item' . ($firstItem ? ' active' : '') . '">
                        <img src="/eng/assets/img/' . $row['url_img'] . '" class="d-block w-100" alt="' . $row['nom_produit'] . '">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>' . $row['nom_produit'] . '</h5>
                            <p>' . $row['description_produit'] . '</p>
                            <p>Prix: ' . $row['prix_produit'] . '</p>
                            <a href="#products" class="btn btn-primary">Demander Devis</a>
                        </div>
                    </div>';

                $firstItem = false; // After the first iteration, set $firstItem to false
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center">Nos Produits</h2>
            <div class="row">
                <?php
                $sqlProduits = "SELECT * FROM produits";
                $resultProduits = $conn->query($sqlProduits);

                if ($resultProduits->num_rows > 0) {
                    while ($rowProduit = $resultProduits->fetch_assoc()) {
                        echo "<div class='col-md-3 mb-4 product-card'>";
                        echo "<div class='card'>";
                        if (!empty($rowProduit['url_img'])) {
                            echo "<img src='/eng/assets/img/" . $rowProduit['url_img'] . "' alt='Image du produit' class='card-img-top img-fluid'>";
                        }
                        echo "<div class='card-body'>";
                        echo "<h4 class='card-title'>" . $rowProduit['nom_produit'] . "</h4>";
                        echo "<p class='card-text'>" . $rowProduit['description_produit'] . "</p>";
                        echo "<p class='card-text'>Prix : $" . $rowProduit['prix_produit'] . "</p>";
                        // Inside the while loop for displaying products
                        echo "<button class='btn btn-primary btn-demande-devis' data-toggle='modal' data-target='#devisModal" . $rowProduit['id'] . "'>Demande Devis</button>";

                        echo "</div></div></div>";
                        echo "<div class='modal fade' id='devisModal" . $rowProduit['id'] . "' tabindex='-1' role='dialog' aria-labelledby='devisModalLabel" . $rowProduit['id'] . "' aria-hidden='true'>'";
                ?>
                        <!-- Bootstrap Modal -->

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="devisModalLabel">Demander un devis</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="devis.php">
                                        <input type="hidden" name="productID" value="<?php echo $rowProduit['id']; ?>">

                                        <!-- Client details fields -->
                                        <div class="form-group">
                                            <label for="nomClient">Nom</label>
                                            <input type="text" class="form-control" id="nomClient" name="nomClient" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="prenomClient">Prénom</label>
                                            <input type="text" class="form-control" id="prenomClient" name="prenomClient" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailClient">Email</label>
                                            <input type="email" class="form-control" id="emailClient" name="emailClient" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telClient">Téléphone</label>
                                            <input type="tel" class="form-control" id="telClient" name="telClient" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="adresseClient">Adresse</label>
                                            <input type="text" class="form-control" id="adresseClient" name="adresseClient" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantite">Quantité</label>
                                            <input type="number" class="form-control" id="quantite" name="quantite" required>
                                        </div>

                                        <!-- Category select dropdown -->
                                        <div class="form-group">
                                            <label for="categorieClient">Catégorie</label>
                                            <select class="form-control" id="categorieClient" name="categorieClient">
                                                <?php
                                                $categoryQuery = "SELECT `id`, `nom_cat` FROM `categories`";
                                                $categoryResult = mysqli_query($conn, $categoryQuery);
                                                while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                                    echo '<option value="' . $categoryRow['id'] . '">' . $categoryRow['nom_cat'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Add other form fields as needed -->

                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
    <?php
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
                $sqlFamilles = "SELECT * FROM familles";
                $resultFamilles = $conn->query($sqlFamilles);
                if ($resultFamilles->num_rows > 0) {
                    while ($rowFamille = $resultFamilles->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-4 family-card'>";
                        echo "<div class='card'>";
                        if (!empty($rowFamille['image_famille'])) {
                            echo "<img src='/eng/assets/img/" . $rowFamille['image_famille'] . "' alt='Image de la famille' class='card-img-top img-fluid'>";
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

    <!-- contact -->
    <section id="contact">
        <div class="container w-50 pt-5 pb-5">
            <h2 style="text-align:center">Contact</h2>
            <?php
            // Vérifier si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les valeurs du formulaire
                $contact_name = $_POST['contact_name'];
                $contact_email = $_POST['contact_email'];
                $contact_phone = $_POST['contact_phone'];
                $contact_message = $_POST['contact_message'];
                $contact_prenom = $_POST['contact_prenom'];

                // Préparer la requête SQL pour insérer les données dans la table 'messages'
                $insertQuery = "INSERT INTO messages (nom, prenom, email, description_message, date_message) 
                    VALUES ('$contact_name', '$contact_prenom', '$contact_email', '$contact_message', NOW())";

                // Exécuter la requête
                if ($conn->query($insertQuery) === TRUE) {
                    // Utiliser une classe Bootstrap pour styliser le message
                    echo "<div class='alert alert-success'>Message enregistré avec succès.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Erreur lors de l'enregistrement du message : " . $conn->error . "</div>";
                }
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="contact_name" required>
                </div>
                <div class="form-group">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="contact_prenom" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="contact_email" required>
                </div>
                <div class="form-group">
                    <label for="contact-phone" class="form-label">Numero telephone :</label>
                    <input type="tel" name="contact_phone" id="contact-phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="contact_message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </section>

    <!-- end contact -->
    <footer class="mt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Nous contacter</h3>
                    <ul>
                        <li><i class="fa fa-map-marker"></i> 123 rue des Arts, Alger</li>
                        <li><i class="fa fa-phone"></i> +213 123 456 789</li>
                        <li><i class="fa fa-envelope"></i> info@eng.dz</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Suivez-nous</h3>
                    <ul class="social-media">

                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <!-- <div class="col-md-4">
                    <h3>Inscription à la newsletter</h3>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Entrez votre email...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">S'abonner</button>
                            </span>
                        </div>
                    </form>
                </div> -->
            </div>
            <h3 class="mt-2 mb-2">Localisation : </h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.662406929224!2d2.9550327!3d36.7306683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128faf74eb2565af%3A0xc8729d6401db0260!2sENG%20Spa%20Entreprise%20nationale%20des%20Granulats!5e0!3m2!1sfr!2sdz!4v1707564820392!5m2!1sfr!2sdz" class="w-100" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
        <div class="bottom-footer mt-4 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0 text-center">&copy; 2024 ENTREPRISE NATIONALE DES GRANULATS.
                            Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <!-- Inclure les fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Inclure les fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>