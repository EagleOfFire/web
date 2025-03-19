<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SeaFight.com</title>
    <link rel="stylesheet" href="index.css">  <!-- Styles globaux -->
    <link rel="stylesheet" href="profil.css"> <!-- Styles spécifiques au profil -->
</head>
<body>
    <div class="profil-container">
        <h2>Mon Profil</h2>
        
        <!-- Menu d'onglets -->
        <div class="tabs">
            <ul class="tab-menu">
                <li class="active" data-tab="informations">Informations</li>
                <li data-tab="personnages">Personnages</li>
                <li data-tab="historique">Historique</li>
            </ul>
            
            <!-- Contenu des onglets -->
            <div class="tab-content active" id="informations">
                <h3>Informations</h3>
                <p><strong>Nom :</strong> Dupont</p>
                <p><strong>Prénom :</strong> Jean</p>
                <p><strong>Email :</strong> jean.dupont@example.com</p>
                <p><strong>Pays :</strong> France</p>
            </div>
            
            <div class="tab-content" id="personnages">
                <h3>Personnages</h3>
                <div class="personnages-list">
                    <div class="personnage">
                        <img src="/images/floyd.png" alt="Floyd Mayweather">
                        <p>Floyd Mayweather</p>
                    </div>
                    <div class="personnage">
                        <img src="/images/ali.png" alt="Mohamed Ali">
                        <p>Mohamed Ali</p>
                    </div>
                    <div class="personnage">
                        <img src="/images/mike.png" alt="Mike Tyson">
                        <p>Mike Tyson</p>
                    </div>
                    <div class="personnage">
                        <img src="/images/usyk.png" alt="Oleksandr Usyk">
                        <p>Oleksandr Usyk</p>
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="historique">
                <h3>Historique</h3>
                <p>Aucune partie jouée pour le moment.</p>
            </div>
        </div>
        
        <!-- Bouton de déconnexion -->
        <div class="logout">
            <a href="main.php" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <!-- Onglets -->
    <script>
        const tabMenuItems = document.querySelectorAll('.tab-menu li');
        const tabContents = document.querySelectorAll('.tab-content');

        tabMenuItems.forEach(item => {
            item.addEventListener('click', function() {
                tabMenuItems.forEach(i => i.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>
</html>
