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
    <title>ENG | Organigramme</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
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

       <!-- start Organigramme ENG -->
       <section class="container mt-5">
        <h2 class="text-center mb-4">Organigramme de l'Entreprise Nationale des Granulats (ENG)</h2>

        <p>
            L’entreprise nationale des Granulat « ENG » est une société par actions (SPA) dotée d’un capital social de trois milliards de dinars, elle fait partie du groupe industriel ManadjamElDjazair « MANAL ».
        </p>

        <p>
            L’entreprise est gérée par un président directeur général assisté par des cadres dirigeants, d'un staff et de directeurs d’unité, selon l’organisation ci-dessous.
        </p>

        <h3>Les directions de l'entreprise</h3>
        <ol>
            <li><strong>Direction Exploitation:</strong>
                <p>
                    C'est la direction de la production, elle est chargée de :
                </p>
                <ul>
                    <li>Conduire les activités d'exploitation de l'entreprise.</li>
                    <li>Recommander les programmes d'exploitation à court terme et suivre leurs exécutions.</li>
                    <li>Définir et mettre en œuvre une politique de maintenance.</li>
                    <li>Prendre en charge les achats groupés.</li>
                    <li>Optimiser la gestion des stocks.</li>
                    <li>Développer des études de recherches au sein des différents sites.</li>
                </ul>
            </li>

            <li><strong>Direction Développement:</strong>
                <p>
                    Elle joue le rôle de centre :
                </p>
                <ul>
                    <li>Développement de nouveaux produits et amélioration des produits existants.</li>
                    <li>Suivi et réalisation des projets d'investissement.</li>
                    <li>Élaboration, en collaboration avec les autres directions, d'études techniques et économiques des projets d'investissement.</li>
                    <li>Réalisation des études, synthèses, prestations d'analyse et d'expérimentation en rapport avec les besoins de l'exploitation et de commercialisation.</li>
                </ul>
            </li>

            <li><strong>Direction des Ressources Humaines:</strong>
                <p>
                    Elle est chargée de :
                </p>
                <ul>
                    <li>Définir la stratégie des politiques et des systèmes de l'entreprise en matière des ressources humaines.</li>
                    <li>Mettre en œuvre les politiques et les plans de développement spécifiques des systèmes d'organisation en matière des ressources humaines.</li>
                    <li>Constituer une capacité d'étude et d'administration auprès des structures ressources humaines des unités de production.</li>
                    <li>Planifier l'évolution des métiers.</li>
                    <li>Veiller au développement de ressources humaines.</li>
                    <li>Mettre à jour le manuel d'organisation de l'entreprise.</li>
                    <li>Prendre en charge la gestion du siège de l'entreprise.</li>
                </ul>
            </li>

            <li><strong>Direction Finances et Comptabilité:</strong>
                <p>
                    C'est la direction du suivi et du contrôle financier; elle a comme missions de :
                </p>
                <ul>
                    <li>Définir la stratégie financière de l'entreprise.</li>
                    <li>Consolider les relations budgétaires financières de l'entreprise.</li>
                    <li>Assister et contrôler les structures financières et comptables des unités.</li>
                    <li>Assurer le montage financier des projets.</li>
                </ul>
            </li>

            <li><strong>Direction Commerciale:</strong>
                <p>
                    Elle est chargée de :
                </p>
                <ul>
                    <li>Définir la stratégie de l'entreprise en matière commerciale.</li>
                    <li>Mettre en oeuvre les politiques de l'entreprise en matière commerciale.</li>
                    <li>Promouvoir des produits de l'entreprise sur les marchés intérieurs et extérieurs.</li>
                    <li>Faire des études de marchés.</li>
                    <li>Assurer une veille sur les marchés de l'entreprise.</li>
                </ul>
            </li>
        </ol>

        <h3>Direction d'Unité</h3>
        <p>
            Le directeur d'unité :
        </p>
        <ul>
            <li>Dirige, gère et coordonne l'ensemble des activités de l'unité pour assurer la réalisation des objectifs.</li>
            <li>Établit le plan annuel de l’unité et veille à sa mise en œuvre une fois adopté par la direction générale de l’entreprise.</li>
            <li>Veille à l’application par les différentes structures de l’unité des politiques arrêtées par l’entreprise.</li>
            <li>Représente l’unité auprès des autorités locales et des organismes publics.</li>
        </ul>
    </section>
    <!-- end Organigramme ENG -->

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