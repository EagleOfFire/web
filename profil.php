<?php
$host = "127.0.0.1";
$dbname = 'boxe_game';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$query = $pdo->query("SELECT * FROM boxeur");
        $boxeur = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($boxeur)) {
            $randomboxeur = $boxeur[array_rand($boxeur)];
            echo "<script>
                document.querySelector('#health_text_right').textContent = '{$randomboxeur['pv']}';
            </script>";
        }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SeaFight.com</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="profil.css">
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
                <p><b>Nom :</b> Dupont</p>
                <p><b>Prénom :</b> Jean</p>
                <p><b>Email :</b> jean.dupont@example.com</p>
                <p><b>Pays :</b> France</p>
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
        
        <!-- Déconnexion -->
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
