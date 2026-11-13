<nav>
    <ul>    
        <li>
            <?php if (!App::$user): ?>
            <a href="/auth/login">Login</a>
            <?php else: ?>
            Hello, <?php echo App::$user->username; ?>!
            <?php endif; ?>
        </li>
        <?php if (App::$user): ?>
            <li>
                <form action="/auth/logout" method="POST">
                    <?php echo App\Services\CSRFService::getTokenInputField(); ?>
                    <button type="submit">Logout</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>
</nav>