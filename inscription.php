<!-- PAGE D'INSCRIPTION -->

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

// Si  connecté alors profil.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: profil.php");
    exit;
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : "";

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } elseif ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM `user` WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Cet email est déjà utilisé.";
        } else {

            $parts = explode('@', $email);
            $pseudo = $parts[0];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO `user` (pseudo, mdp, nom, prenom, genre, email) VALUES (:pseudo, :mdp, '', '', 'Autre', :email)");
            $result = $stmt->execute([
                'pseudo' => $pseudo,
                'mdp' => $hashedPassword,
                'email' => $email
            ]);
            if ($result) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $pdo->lastInsertId();
                header("Location: profil.php");
                exit;
            } else {
                $error = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SeaFight.com</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <div class="signup-container">
        <h2>Inscription</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="inscription.php">
            <div class="form-group">
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre :</label>
                <input type="genre" id="genre" name="genre" placeholder="Votre Genre" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="nom" id="nom" name="nom" placeholder="Votre Nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="prenom" id="prenom" name="prenom" placeholder="Votre Prenom" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe" required>
            </div>
            <div class="button-group">
                <button type="submit" class="btn">S'inscrire</button>
                <a href="connexion.php" class="btn btn-secondary">Déjà un compte ? Connectez-vous</a>
            </div>
        </form>
    </div>
</body>
</html>
