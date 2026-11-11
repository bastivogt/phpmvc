<?php getPartial('Partials/header', ['title' => $title]) ?>
<h1><?php echo esc($title); ?><?php if ($todo->done) { echo ' (Done)'; } ?></h1>
<p><?php echo esc($todo->description); ?></p>

<p>
    <a href="/todos">Back to todos</a>
    <a href="/todos/<?php echo $todo->id; ?>/edit">Edit</a>
    <a href="/todos/<?php echo $todo->id; ?>/delete">Delete</a>
</p>
<?php getPartial('Partials/footer'); ?>