<?php $this->extend("Layouts/default"); ?>
<?php $this->section("title"); ?>
    <?php echo esc($title); ?>
<?php $this->endSection(); ?>
<?php $this->section("content"); ?>
<h1>Delete Todo</h1>
<p>Are you sure you want to delete this todo?</p>
<form method="POST" action="/todos/<?php echo $todo->id; ?>/delete">
    <button type="submit">Delete</button>
</form>
<p>
    <a href="<?php echo previousUrl(); ?>">Cancel</a>
</p>
<?php $this->endSection(); ?>