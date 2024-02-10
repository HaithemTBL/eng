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
    <title>ENG | Qualité</title>
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

  <!-- start Qualité ENG -->
  <section class="container mt-5">
        <h2 class="text-center mb-4">Politique Qualité et Engagement de la Direction</h2>

        <p>
            L’Entreprise Nationale des Granulats (ENG) a toujours eu pour souci la fabrication et la fourniture de produits de qualité dans un contexte d’écoute continuelle du client.
        </p>

        <p>
            La direction de l’ENG s’est engagée dans une démarche de Management de Qualité, considérant qu’il s’agit d’un axe stratégique pour sa reconnaissance, son développement et sa pérennité.
        </p>

        <p>
            J’ai décidé la mise en place d’un système de management de la qualité conforme au référentiel ISO 9001 Version 2000. Notre politique est basée sur les objectifs suivants :
        </p>

        <ul>
            <li>La satisfaction des besoins du client en produits de qualité selon ses exigences à des prix compétitifs et dans les délais,</li>
            <li>La préservation de la part de marché de l’entreprise,</li>
            <li>Le développement de la gamme des produits.</li>
        </ul>

        <p>
            La contribution et l’adhésion de chaque employé sont nécessaires pour déployer le système Management de la Qualité à tous les niveaux dans un esprit de responsabilisation, d’écoute et de dialogue.
        </p>

        <p>
            Un tel projet d’entreprise doit être piloté par un coordinateur. Une assistante de management de la qualité a été désignée pour mettre en place, entretenir un système de management de la qualité efficace et de me rendre compte de son fonctionnement.
        </p>

        <p>
            Je m’engage personnellement :
        </p>

        <ul>
            <li>A mettre en œuvre tous les moyens nécessaires à la réussite de notre démarche,</li>
            <li>A contribuer à l’amélioration permanente, de notre système de management de la qualité pour satisfaire nos clients,</li>
            <li>A vous communiquer les résultats obtenus.</li>
        </ul>

        <p>
            J’encourage l’ensemble du personnel et particulièrement celui des unités de production à participer pleinement à cette démarche afin de bâtir ensemble une entreprise performante, profitable et pérenne.
        </p>

        <h2 class="text-center mt-5 mb-4">Contrôle Qualité</h2>

        <h3>Laboratoire Central</h3>

        <p>
            Le contrôle de qualité des produits de l'E.N.G est assuré par le laboratoire central qui est équipé d'un matériel moderne et normatif afin de réaliser les essais pour la détermination des caractéristiques de fabrication et intrinsèques des granulats suivant des modes opératoires bien définis et normalisés.
        </p>

        <p>
            Le laboratoire central est en contact permanent avec les laboratoires de toutes les unités, neuf au total, pour la collecte des résultats d'essais effectués au sein de ces laboratoires qui sont équipés  d'ailleurs d'un matériel qui permet parfaitement le contrôle de la production et pour le prélèvement mensuel des échantillons.
        </p>

        <p>
            Tous les résultats obtenus sont traités par un logiciel récent des granulats afin d'établir des fiches techniques et des cartes de contrôle pour le suivi continu de la qualité des produits élaborés.
        </p>

        <h3>Contrôle Granulats</h3>

        <p>
            Les analyses effectuées pour contrôler les caractéristiques de fabrication des granulats sont:
        </p>

        <ul>
            <li>La granularité</li>
            <li>L'épaisseur moyenne</li>
            <li>La propreté superficielle</li>
            <li>Le coefficient LOS ANGELES</li>
            <li>Le coefficient MICRO DEVAL</li>
        </ul>

        <h3>Contrôle Matière Première et Produits Finis</h3>

        <p>
            Le laboratoire Central assure aussi le suivi de la qualité de la matière première et des produits finis de l'usine de carbonate de calcium.
        </p>

        <h4>Matière Première :</h4>

        <ul>
            <li>Concassage</li>
            <li>Broyage</li>
            <li>Détermination de la teneur en Carbonate de Calcium</li>
            <li>Détermination de la blancheur</li>
            <li>Analyse chimique (sous-traitée)</li>
            <li>Analyse Toxicologique (sous-traitée)</li>
        </ul>

        <h4>Produits Finis :</h4>

        <ul>
            <li>Analyse granulométrique par diffraction laser</li>
            <li>Détermination de la teneur en Carbonate de Calcium</li>
            <li>Détermination de la blancheur</li>
            <li>Détermination de la prise d'huile</li>
            <li>Détermination de la prise D O P</li>
            <li>Détermination de l'humidité naturelle</li>
        </ul>

        <h3>Laboratoires d'Unités</h3>

        <h4>Granulats :</h4>

        <p>
            C'est pour assurer une régularité des produits élaborés que l'ENG a créé un laboratoire de contrôle de la qualité au niveau de chaque unité. Ces laboratoires sont dotés d'un équipement moderne qui répond aux normes européennes pour la détermination des caractéristiques de fabrication des granulats élaborés par toutes les unités.
        </p>

        <h4>Carbonate de Calcium :</h4>

        <p>
            Ce laboratoire conçu spécialement pour le contrôle de la production et de l'équipement de l'usine de Carbonate de Calcium. Il est équipé aussi d'un matériel moderne et récent pour réaliser les essais suivants :
        </p>

        <ul>
            <li>Analyse granulométrique par dépression d'air</li>
            <li>Détermination de la blancheur</li>
            <li>Détermination de l'humidité naturelle</li>
        </ul>

        <h3>Normes et Documents</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dénomination</th>
                    <th>Description</th>
                    <th>Document</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Norme NA 2607-190</td>
                    <td>Analyse Granulométrique par Tamisage</td>
                    <td></td>
                </tr>
                <!-- Ajoutez les autres lignes en fonction de vos besoins -->
            </tbody>
        </table>
    </section>
    <!-- end Qualité ENG -->


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