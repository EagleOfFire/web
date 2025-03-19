<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeaFight.com</title>
    <link rel="stylesheet" href="index.css">

</head>
<body>

    <?php session_start(); ?>
    <?php include "header.php"; ?>  <!-- Header -->

    <?php 
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {
            case "Accueil":
                include "main.php";
                break;
            case "Combat":
                include "main.php";
                break;
            case "Profil":
                include "connexion.php";
                break;
            default:
                include "main.php";
                break;
        }
    } else {
        include "main.php";
    } 
    ?>

    <?php include "footer.php"; ?>  <!-- Footer -->
    
</body>
</html>
