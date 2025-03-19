<?php

// Si l'utilisateur est déjà connecté, on redirige vers son profil
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

    // Vérification des champs
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } elseif ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Ici, normalement, vous stockeriez ces informations dans une base de données.
        // Pour l'instant, on les sauvegarde temporairement dans la session.
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        // Redirection vers le profil après inscription
        header("Location: profil.php");
        exit;
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
