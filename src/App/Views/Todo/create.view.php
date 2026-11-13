<?php $this->extend("Layouts/default"); ?>
<?php $this->section("title"); ?>
    <?php echo esc($title); ?>
<?php $this->endSection(); ?>
<?php $this->section("content"); ?>
<h1>Create Todo</h1>

<?php if(!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="/todos" novalidate>
    <?php $this->include('Todo/_form', ['todo' => $todo]); ?>
    
    <p>
        <button type="submit">Create</button>
    </p>
</form>
<p>
    <a href="<?php echo previousUrl(); ?>">Cancel</a>
</p>
<?php $this->endSection(); ?>