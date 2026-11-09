<?php getPartial("Partials/header", ['title' => "Create Product"]); ?>
<h1>Create Product</h1>
<?php if(!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/products" method="post" novalidate>
    <?php getPartial("Product/_form", ['name' => $product['name'] ?? '', 'description' => $product['description'] ?? '']); ?>
    <br>
    <button type="submit">Create</button>
</form>

<p>
    <a href="<?php echo previousUrl(); ?>">Back to Products</a>
</p>

<?php getPartial("Partials/footer"); ?>