<footer>
        <p>&copy; 2025 SeaFight - Tous droits réservés.</p>
</footer>

<?php if (isset($_COOKIE["dernier_page"])) {
    echo "Dernière page visitée : " . htmlspecialchars($_COOKIE["dernier_page"]);
} else {
    echo "Aucune page consultée récemment.";
}?>
