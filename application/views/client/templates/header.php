<header>
    <div class="container">
        <nav>
            <a class="button" href="/admin">
                Страница администратора
            </a>
            <?php if ($_SESSION['user'] ?? false) : ?>
                <div class="functional">
                    <button class="button" id="exit" type="button">Выйти</button>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>