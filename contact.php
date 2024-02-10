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

$unites = [
    [
        'Unité' => 'EL KHROUB (Granulats)',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Constantine',
        'Contact' => 'Mr BENCHAOUI Toufik',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N13 El Khroub - Constantine',
        'Tél' => '0660 37 96 10',
        'Email' => 'elkhroubgranulats@eng.dz',
    ],
    [
        'Unité' => 'EL KHROUB (Granulats)',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Constantine',
        'Contact' => 'Mr TABTI Said',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N13 El Khroub - Constantine',
        'Tél' => '0660 40 32 11',
        'Email' => 'elkhroubgranulats@eng.dz',
    ],
    [
        'Unité' => 'BEN AZZOUZ',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Skikda',
        'Contact' => 'Mr ZAHAR AOMAR',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP 16 Ben Azzouz - Skikda',
        'Tél' => '0660 40 32 03',
        'Email' => 'benazzouz@eng.dz',
    ],
    [
        'Unité' => 'BEN AZZOUZ',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Skikda',
        'Contact' => 'Mr DJILANI Mohamed',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP 16 Ben Azzouz - Skikda',
        'Tél' => '0660 40 32 16',
        'Email' => 'benazzouz@eng.dz',
    ],
    [
        'Unité' => 'AIN TOUTA',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Batna',
        'Contact' => 'Mr YOUCEFI Mourad',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP 55 Ain Touta - Batna',
        'Tél' => '0660 37 68 90',
        'Email' => 'aintouta@eng.dz',
    ],
    [
        'Unité' => 'BOUZEGZA',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Bouira',
        'Contact' => 'Mr MOUMENI Zine El Abidine',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N11 El Hachimia - Bouira',
        'Tél' => '0660 37 68 31',
        'Email' => 'elhachimia@eng.dz',
    ],
    [
        'Unité' => 'BOUZEGZA',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Bouira',
        'Contact' => 'Mr TAMZOUGTHT Nadjib',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N11 El Hachimia - Bouira',
        'Tél' => '0660 40 32 31',
        'Email' => 'elhachimia@eng.dz',
    ],
    [
        'Unité' => 'ELMA LABIOD',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Tébessa',
        'Contact' => 'Mr RAMDANE Zoheir',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N 04 Elmalabiod - Tebessa',
        'Tél' => '0660 37 68 96',
        'Email' => 'elmalabiod@eng.dz',
    ],
    [
        'Unité' => 'ELMA LABIOD',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Tébessa',
        'Contact' => 'Mr ABADA Fethi',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N 04 Elmalabiod - Tebessa',
        'Tél' => '0660 37 68 96',
        'Email' => 'elmalabiod@eng.dz',
    ],
    [
        'Unité' => 'EL KHROUB (Carbonate de Calcium)',
        'Type' => 'Carbonate de calcium',
        'Région' => 'Est',
        'Wilaya' => 'Constantine',
        'Contact' => 'Mr BENCHAOUI Toufik',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N13 El Khroub - Constantine',
        'Tél' => '0660379610',
        'Fax' => '031 95 01 25',
        'Email' => 'elkhroubcaco3@eng.dz',
    ],
    [
        'Unité' => 'EL KHROUB (Carbonate de Calcium)',
        'Type' => 'Carbonate de calcium',
        'Région' => 'Est',
        'Wilaya' => 'Constantine',
        'Contact' => 'Mr DJOUABLIA Mohamed',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N13 El Khroub - Constantine',
        'Tél' => '0660 40 32 14',
    ],
    [
        'Unité' => 'AIN TOUTA',
        'Type' => 'Granulats',
        'Région' => 'Est',
        'Wilaya' => 'Batna',
        'Contact' => 'Mr TAYEB Abdelhamid',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP 55 Ain Touta-Batna',
        'Tél' => '0660 37 68 90',
        'Email' => 'aintouta@eng.dz',
    ],
    [
        'Unité' => 'DIRECTION GENERALE',
        'Type' => 'Direction générale',
        'Région' => 'Centre',
        'Wilaya' => 'Alger',
        'Contact' => 'Mr FILLALI Fethi',
        'Fonction' => 'Directeur Commercial',
        'Adresse' => 'Cité Administrative Lot N° 135 Ouled Fayet-Alger',
        'Tél' => '023 29 63 37 / 38 / 39',
        'Fax' => '023 29 63 30 / 31',
        'Email' => 'dc@eng.dz',
    ],
    [
        'Unité' => 'SI MUSTAPHA',
        'Type' => 'Granulats',
        'Région' => 'Centre',
        'Wilaya' => 'Boumerdès',
        'Contact' => 'Mr DEY Amor',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP 40 Thenia - Boumerdes',
        'Tél' => '0660 37 96 08',
        'Email' => 'simustapha@eng.dz',
    ],
    [
        'Unité' => 'SI MUSTAPHA',
        'Type' => 'Granulats',
        'Région' => 'Centre',
        'Wilaya' => 'Boumerdès',
        'Contact' => 'Mr TALAMALI Sofiane',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP 40 Thenia - Boumerdes',
        'Tél' => '0660 40 32 23',
        'Email' => 'simustapha@eng.dz',
    ],
    [
        'Unité' => 'DIRECTION GENERALE',
        'Type' => 'Direction générale',
        'Région' => 'Centre',
        'Wilaya' => 'Alger',
        'Contact' => 'Mme TAHAR BELLAR Hassiba',
        'Fonction' => 'Attaché de Direction',
        'Adresse' => 'Cité Administrative Lot N° 135 Ouled Fayet-Alger',
        'Tél' => '023 29 63 37 / 38 / 39',
        'Fax' => '023 29 63 30 / 31',
        'Email' => 'dc@eng.dz',
    ],
    [
        'Unité' => 'DEPOT GUE DE CONSTATINE',
        'Type' => 'Carbonate de calcium',
        'Région' => 'Centre',
        'Wilaya' => 'Alger',
        'Contact' => 'Mr REBHI Brahim',
        'Fonction' => 'Responsable Dépôt Gué de Constantine',
        'Adresse' => 'ZI Gué de constantine',
        'Tél' => '0660 37 68 16',
    ],
    [
        'Unité' => 'DIRECTION GENERALE',
        'Type' => 'Direction générale',
        'Région' => 'Centre',
        'Wilaya' => 'Alger',
        'Contact' => 'Mr BESSEKRI Mohamed',
        'Fonction' => 'Directeur Général',
        'Adresse' => 'Cité Administrative Lot N° 135 Ouled Fayet-Alger',
    ],
    [
        'Unité' => 'EL MALEH',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr BENAZZA Labdelli',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N02 El Maleh - Ain Temouchent',
        'Tél' => '0660 37 96 06',
        'Email' => 'elmaleh@eng.dz',
    ],
    [
        'Unité' => 'SIDI ALI BENYOUB',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Sidi Bel Abbès',
        'Contact' => 'Mr MAHIEDDINE Zouhir',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N 22310 Sidi Ali Benyoub - Sidi Bel Abbes',
        'Tél' => '0660 37 96 01',
        'Email' => 'sidialibenyoub@eng.dz',
    ],
    [
        'Unité' => 'SIDI ALI BENYOUB',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Sidi Bel Abbès',
        'Contact' => 'Mr HAMIDI Mankour',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N 22310 Sidi Ali Benyoub - Sidi Bel Abbes',
        'Tél' => '0660 40 32 01',
        'Email' => 'sidialibenyoub@eng.dz',
    ],
    [
        'Unité' => 'SIDI ABDELLI',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Tlemcen',
        'Contact' => 'Mr ZAOUM Bouabdellah',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N 37 Sidi Abdelli - Tlemcen',
        'Tél' => '0660 40 32 22',
        'Email' => 'sidiabdelli@eng.dz',
    ],
    [
        'Unité' => 'EL MALEH',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr CHAREF Fewzi',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N02 El Maleh - Ain Temouchent',
        'Tél' => '0660 40 32 20',
        'Email' => 'elmaleh@eng.dz',
    ],
    [
        'Unité' => 'PIERRE et MARBRE (RoCaAL)',
        'Type' => 'Pierre et Marbre',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr BENHAMIDA Abdelkarim',
        'Fonction' => 'Directeur',
        'Tél' => '0660 36 15 81',
        'Email' => 'rocaal@eng.dz',
    ],
    [
        'Unité' => 'PIERRE et MARBRE (RoCaAL)',
        'Type' => 'Pierre et Marbre',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr DJILLALI Fouad',
        'Fonction' => 'Chef service commercial',
        'Tél' => '0660 36 15 82',
        'Email' => 'rocaal@eng.dz',
    ],
    [
        'Unité' => 'POUZZOLANE',
        'Type' => 'Pouzzolane',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr MIRAOUI Khaled',
        'Fonction' => 'Directeur',
        'Adresse' => 'BP N° 143 Beni Saf',
        'Tél' => '0660 37 68 44',
        'Email' => 'benisaf@eng.dz',
    ],
    [
        'Unité' => 'POUZZOLANE',
        'Type' => 'Pouzzolane',
        'Région' => 'Ouest',
        'Wilaya' => 'Aïn Témouchent',
        'Contact' => 'Mr CHEBBAB Mohamed',
        'Fonction' => 'Chef Service Commercial',
        'Adresse' => 'BP N° 143 Beni Saf',
        'Tél' => '0667 14 34 69',
        'Email' => 'benisaf@eng.dz',
    ],
    [
        'Unité' => 'SIDI ABDELLI',
        'Type' => 'Granulats',
        'Région' => 'Ouest',
        'Wilaya' => 'Tlemcen',
        'Contact' => 'Mr HACINI Zakaria',
        'Fonction' => 'Chef Service Commercial',
        'Adresse' => 'BP N 37 Sidi Abdelli - Tlemcen',
        'Tél' => '0660 40 32 22',
        'Email' => 'sidiabdelli@eng.dz',
    ],
    [
        'Contact' => 'Mr BENMANSOUR Abdelkader',
        'Fonction' => 'Chef service commercial',
        'Adresse' => 'BP N02 El Maleh - Ain Temouchent',
        'Tél' => '0660 40 32 20',
        'Fax' => '040 97 59 97',
        'Email' => 'elmaleh@eng.dz',
    ],
    [
        'Contact' => 'Mr Kacem',
        'Fonction' => 'Responsable Dépôt Essenia',
        'Adresse' => 'Gare des Marchandises de SENIA ( SNTF )',
        'Tél' => '0660 37 68 14',
        'Fax' => '041 51 48 94',
    ],
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENG | Contact</title>
    <link rel="stylesheet" href="/eng/assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/eng/assets/css/style.css"> <!-- Ajoutez un fichier CSS pour personnaliser le style -->
    <script src="/eng/assets/js/bootstrap.min.js"></script>
    <style>
        .wilaya-data {
            display: none;
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
    <div class="container">
        <h1 class="h3 text-center m-5">Liste des Unités</h1>

        <div class="btn-group d-flex align-items-center m-5" role="group" aria-label="Wilaya Buttons">
            <?php
            // Récupérer toutes les wilayas distinctes
            $wilayas = array_unique(array_column($unites, 'Wilaya'));

            // Afficher chaque wilaya comme un bouton
            foreach ($wilayas as $wilaya) {
                echo "<button type='button' class='btn btn-secondary wilaya-item ml-2' data-wilaya='$wilaya'>$wilaya</button>";
            }
            ?>
        </div>


        <!-- </div> -->

        <?php
        // Afficher les données de chaque unité dans des divs séparées par wilaya
        foreach ($wilayas as $wilaya) {
            echo "<div class='wilaya-data container' id='wilaya-$wilaya'>";

            // Utiliser la fonction d'affichage pour la wilaya spécifique
            afficherUnitesParWilaya($unites, $wilaya);

            echo "</div>";
        }
        ?>


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
    </div>
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
    <script>
        // Récupérer la liste des éléments li avec la classe 'wilaya-item'
        var wilayaItems = document.querySelectorAll('.wilaya-item');

        // Ajouter un écouteur d'événements à chaque élément li
        wilayaItems.forEach(function(item) {
            item.addEventListener('click', function() {
                // Cacher toutes les divs avec la classe 'wilaya-data'
                document.querySelectorAll('.wilaya-data').forEach(function(div) {
                    div.style.display = 'none';
                });

                // Afficher la div spécifique liée à la wilaya sélectionnée
                var wilaya = item.getAttribute('data-wilaya');
                document.getElementById('wilaya-' + wilaya).style.display = 'block';
            });
        });
    </script>

</body>

</html>

<?php
// Fonction pour afficher les unités filtrées par wilaya
// Fonction pour afficher les unités filtrées par wilaya
function afficherUnitesParWilaya($data, $wilaya)
{
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th>Unité</th>";
    echo "<th>Type</th>";
    echo "<th>Région</th>";
    echo "<th>Wilaya</th>";
    echo "<th>Contact</th>";
    echo "<th>Fonction</th>";
    echo "<th>Adresse</th>";
    echo "<th>Tél</th>";
    echo "<th>Fax</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($data as $unite) {
        if (@$unite['Wilaya'] == $wilaya) {
            echo "<tr>";
            echo "<td>" . @$unite['Unité'] . "</td>";
            echo "<td>" . @$unite['Type'] . "</td>";
            echo "<td>" . @$unite['Région'] . "</td>";
            echo "<td>" . @$unite['Wilaya'] . "</td>";
            echo "<td>" . @$unite['Contact'] . "</td>";
            echo "<td>" . @$unite['Fonction'] . "</td>";
            echo "<td>" . @$unite['Adresse'] . "</td>";
            echo "<td>" . @$unite['Tél'] . "</td>";

            // Check and display Fax and Email if they exist
            echo "<td>" . (isset($unite['Fax']) ? $unite['Fax'] : "") . "</td>";
            echo "<td>" . (isset($unite['Email']) ? $unite['Email'] : "") . "</td>";

            echo "</tr>";
        }
    }
    echo "</tbody>";
    echo "</table>";
}



?>