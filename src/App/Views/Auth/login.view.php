<?php $this->extend('Layouts/default') ?>
<?php $this->section('title') ?>
    Login
<?php $this->endSection() ?>
<?php $this->section('content') ?>
    <?php if (\App\Services\ErrorService::hasErrors()) : ?>
        <ul class="error">
            <?php foreach (\App\Services\ErrorService::getErrors() as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="/auth/login">
        <?= \App\Services\CSRFService::getTokenInputField() ?>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= esc(old('email', '')) ?>">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
<?php $this->endSection() ?>