<nav class="functionality">
    <?php if ($_SESSION['user'] ?? false) : ?>
        <button class="button submit" id="exit" type="button">Назад</button>
    <?php endif; ?>
</nav>