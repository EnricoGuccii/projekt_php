<footer>
    Zalogowano jako: 
    <?php
    if (isset($_SESSION['user_id'])) {
        echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
    } else {
        
        echo "Gość";
    }
    ?>
</footer>
