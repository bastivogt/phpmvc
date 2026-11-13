<?php $this->extend("Layouts/default"); ?>
<?php $this->section("title"); ?>
    <?php echo esc($title); ?>
<?php $this->endSection(); ?>
<?php $this->section("content"); ?>
<h1>Edit Todo</h1>

<?php if(!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="/todos/<?php echo $todo->id; ?>">
    <?php $this->include('Todo/_form', ['todo' => $todo]); ?>
    <p>
        <button type="submit">Update</button>
    </p>
</form>
<p>
    <a href="<?php echo previousUrl(); ?>">Cancel</a>
</p>
<?php $this->endSection(); ?>