<?php getPartial("Partials/header", ['title' => $title]); ?>
<h1>Product Index</h1>
<p>
    <a href="/products/create">Create New Product</a>
</p>
<?php if(!empty($products)) : ?>
    <ul>
        <?php foreach($products as $product) : ?>
            <li><a href="/products/<?php echo esc($product['id']); ?>"><?php echo $product['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No products found.</p>
<?php endif; ?>

<?php getPartial("Partials/footer"); ?>