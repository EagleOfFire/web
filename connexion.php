<!-- PAGE DE CONNEXION -->

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

// Si connecté, alors profil.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: profil.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    
    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['mdp'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: profil.php");
            exit;
        } else {
            $error = "Identifiants incorrects.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SeaFight.com</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="connexion.php">
            <div class="form-group">
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <div class="button-group">
                <button type="submit" class="btn">Connexion</button>
                <a href="inscription.php" class="btn btn-secondary">Inscription</a>
            </div>
        </form>
    </div>
</body>
</html>