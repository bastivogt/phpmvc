<?php getPartial("Partials/header", ['title' => $title]); ?>
<h1><?php echo $title; ?></h1>
<?php if(!empty($product)) : ?>
    <p><?php echo $product['description']; ?></p>
<?php else : ?>
    <p>Product not found.</p>
<?php endif; ?>

<p>
    <a href="<?php echo previousUrl(); ?>">Back to Products</a>
</p>

<?php getPartial("Partials/footer"); ?>