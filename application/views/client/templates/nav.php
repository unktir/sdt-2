<nav class="functionality">
    <?php if ($_SESSION['user'] ?? false) : ?>
        <button class="button" id="exit" type="button">Выйти</button>
    <?php endif; ?>
</nav>