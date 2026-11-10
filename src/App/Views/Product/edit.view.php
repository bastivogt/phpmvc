<?php getPartial('Partials/header', ['title' => 'Edit Product']); ?>
<h1>Edit Product</h1>
<?php if(!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/products/<?php echo $product['id']; ?>" method="post">
    <?php getPartial('Product/_form', [
        'name' => esc($product['name']) ?? '',
        'description' => esc($product['description']) ?? ''
    ]); ?>
    <br>
    <button type="submit">Update</button>
</form>
<?php getPartial('Partials/footer'); ?>