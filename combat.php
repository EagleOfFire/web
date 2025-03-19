<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="combat.css">
    <link rel="stylesheet" href="attack_button.css">
    <title>Document</title>
</head>
<body>

    <?php
    $host = "127.0.0.1";
    $dbname = "boxe_game";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    $query = $pdo->query("SELECT * FROM boxeur");
    $boxeur = $query->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($boxeur)) {
        $randomboxeur = $boxeur[array_rand($boxeur)];
        echo "<script>
                    document.querySelector('#health_text_right').textContent = '{$randomboxeur["pv"]}';
                </script>";
    }
    ?>

    <?php
    $userBoxeur = [
        "vitesse" => 30,
        "attaque" => 30,
        "pvmax" => 100,
        "pvactuel" => 100,
    ];

    $enemieBoxeur = [
        "vitesse" => $randomboxeur["vitesse"],
        "attaque" => $randomboxeur["attaque"],
        "pvmax" => $randomboxeur["pv"],
        "pvactuel" => $randomboxeur["pv"],
    ];
    ?>

    <div class="round_number">Round 1</div>
    <div class="health_background" id="health_background_left"></div>
    <div class="health_bar" id="health_bar_left"></div>
    <div class="health_text" id="health_text_left">100</div>
    <div class="health_background" id="health_background_right"></div>
    <div class="health_bar" id="health_bar_right"></div>
    <div class="health_text" id="health_text_right">100</div>

    <img src="./images/default_fighter.png" alt="Left boxeur" class="left_fighter">
    <img src="./images/default_fighter.png" alt="Right boxeur" class="right_fighter">

    <?php
    if (array_key_exists("attaque", $_POST)) {
        attaque();
    }
    function attaque()
    {
        $userVitesse = $userBoxeur["vitesse"];
        $userResultatVitesse = rand(0, $userVitesse);
        $enemieVitesse = $enemieBoxeur["vitesse"];
        $enemieRandomNumber = rand(0, $enemieVitesse);
        if ($userResultatVitesse > $enemieRandomNumber) {
            $userPuissance = rand(0, $userBoxeur["attaque"]);
            $enemieBoxeur["pvactuel"] -= $userPuissance;
            echo "<script>
                        document.querySelector('#health_text_right').textContent = '{$enemieBoxeur["pvactuel"]}';
                    </script>";
        } elseif ($userResultatVitesse < $enemieRandomNumber) {
            $enemiePuissance = rand(0, $enemieBoxeur["attaque"]);
            $userBoxeur["pvactuel"] -= $enemiePuissance;
            echo "<script>
                        document.querySelector('#health_text_left').textContent = '{$userBoxeur["pvactuel"]}';
                    </script>";
        } else {
            echo "Attaque annulé<br>";
        }
    }
    ?>
        <form method="post" class="attaque_boutton">
            <input type="submit" name="attaque"
                    class="button"  value="Attaque"/>

        </form>

<!--     <div class="container-button">
        <div class="hover bt-1"></div>
        <div class="hover bt-2"></div>
        <div class="hover bt-3"></div>
        <div class="hover bt-4"></div>
        <div class="hover bt-5"></div>
        <div class="hover bt-6"></div>
    </div> -->
</body>
</html>