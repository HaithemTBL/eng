<?php
include 'config/bdd.php';


// Récupérer les familles depuis la base de données
$sqlFamilles = "SELECT * FROM familles";
$resultFamilles = $conn->query($sqlFamilles);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | Conditions de Vente</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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


  <!-- start Conditions de Vente ENG -->
  <section class="container mt-5">
        <h2 class="text-center mb-4">Dispositions Générales</h2>

        <h3>Ventes - Fabrication</h3>

        <p>
            La commercialisation des produits ENG s'effectue entièrement au niveau des unités. C'est auprès des services commerciaux de ces dernières que sont enregistrées les commandes et que sont concrétisés les enlèvements ou les livraisons. La vente des produits est comptabilisée en tonne: le tonnage enlevé ou livré est constaté par un pont bascule dont l'étalonnage et le contrôle est confié à l'ONML (organisme officiel habilité).
        </p>

        <h4>Prix</h4>

        <p>
            Les prix de vente des produits sont fixés par décision de la direction. Cette décision fait l'objet d'une large diffusion auprès de la clientèle existante ou potentielle. Les prix fixés sont appelés prix catalogue. Ils s'appliquent à toute la clientèle.
        </p>

        <h4>Paiements</h4>

        <p>
            Les unités établissent des factures :
        </p>

        <ul>
            <li>Conforme aux enlèvements individuels. Dans ces cas, le paiement doit intervenir au moment de la facturation.</li>
            <li>Bimensuelles ou mensuelles. Dans ces cas, le paiement doit intervenir :
                <ul>
                    <li>Par avance pour les clients non contractuels.</li>
                    <li>Selon les termes du contrat pour les clients contractuels.</li>
                </ul>
            </li>
        </ul>

        <p>
            Les formes de paiements acceptées sont:
        </p>

        <ul>
            <li>Les chèques de banque</li>
            <li>Les chèques</li>
            <li>Les virements</li>
            <li>Les traites avalisées et acceptées</li>
            <li>Les espèces</li>
        </ul>

        <h4>Dispositions Particulières</h4>

        <h5>Granulats</h5>

        <p>
            Les prix de vente des produits sont fixés pour la durée d'un trimestre. Les contrats sont conclus par l'unité de production avec une durée de validité des prix de six (6) mois maximum pour les clients qui désirent s'assurer un approvisionnement important et régulier.
        </p>

        <p>
            A la demande des clients, l'unité peut prendre en charge les prestations de transport.
        </p>

        <h5>Carbonate de Calcium</h5>

        <p>
            Les prix des produits sont fixés pour la durée d'une année. Les contrats sont conclus par la direction générale.
        </p>

        <p>
            Les contrats prévoient :
        </p>

        <ul>
            <li>des remises quand les quantités achetées dépassent un certain niveau.</li>
            <li>des encouragements pour certains produits emballés en big bag.</li>
        </ul>

        <p>
            Les tarifs des produits carbonate de calcium sont au nombre de quatre (4):
        </p>

        <ul>
            <li>départ usine: en vrac, en big bag et en sacs palettisés houssés.</li>
            <li>départ dépôt El Khroub : en big bag et en sacs palettisés pour tous types de clientèle.</li>
            <li>départ dépôt Rouiba : en big bag et en sacs palettisés pour tous types de clientèle.</li>
            <li>départ dépôt Senia : en big bag et en sacs palettisés pour tous types de clientèle.</li>
        </ul>

        <h4>Dispositions Applicables à l'Unité RoCaAL</h4>

        <h5>Ventes - Fabrication</h5>

        <p>
            La commercialisation des produits RoCaAl s'effectue au niveau de la direction de l'unité. Les carrières concrétisent des opérations de mise à disposition et de chargements des blocs. La vente des produits est comptabilisée en m3, les blocs sont mesurés par le personnel de la carrière et réceptionnés par les représentants du client.
        </p>

        <h5>Prix</h5>

        <p>
            Les prix de vente des produits sont fixés par décision annuelle de la direction. Ils s'appliquent à toute la clientèle. Ces prix sont fonction du volume des blocs et de leur qualité pour une même pierre ornementale.
        </p>

        <h5>Paiements</h5>

        <p>
            Les paiements s'effectuent au niveau de la direction de l'unité et des carrières.
        </p>
    </section>
    <!-- end Conditions de Vente ENG -->



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