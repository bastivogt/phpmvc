<?php $this->extend("Layouts/default"); ?>
<?php $this->section("title"); ?>
    <?php echo esc($title); ?>
<?php $this->endSection(); ?>
<?php $this->section("content"); ?>
<h1>Todo Index</h1>
<p>
    <a href="/todos/create">Create New Todo</a>
</p>
<?php if(!empty($todos)) : ?>
    <ul>
        <?php foreach($todos as $todo) : ?>
            <li><a href="/todos/<?php echo esc($todo->id); ?>"><?php echo $todo->title; ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No todos found.</p>
<?php endif; ?>

<?php $this->endSection(); ?>