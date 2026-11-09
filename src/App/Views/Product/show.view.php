<?php getPartial("Partials/header", ['title' => esc($title)]); ?>
<h1><?php echo esc($title); ?></h1>
<?php if(!empty($product)) : ?>
    <p><?php echo esc($product['description']); ?></p>
<?php else : ?>
    <p>Product not found.</p>
<?php endif; ?>

<p>
    <a href="/products">Back to Products</a>
    <a href="/products/<?php echo $product['id'] ?? ''; ?>/edit">Edit Product</a>
    <a href="/products/<?php echo $product['id'] ?? ''; ?>/delete">Delete Product</a>
</p>

<?php getPartial("Partials/footer"); ?>