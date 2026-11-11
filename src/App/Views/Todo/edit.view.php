<?php getPartial('Partials/header', ['title' => $title]) ?>
<h1>Edit Todo</h1>

<?php if(!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="/todos/<?php echo $todo->id; ?>">
    <?php getPartial('Todo/_form', ['todo' => $todo]); ?>
    <p>
        <button type="submit">Update</button>
    </p>
</form>
<p>
    <a href="<?php echo previousUrl(); ?>">Cancel</a>
</p>
<?php getPartial('Partials/footer'); ?>