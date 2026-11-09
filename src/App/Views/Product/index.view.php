<?php include srcPath("App/Views/Partials/header.php"); ?>
<h1>Product Index</h1>
<?php if(!empty($products)) : ?>
    <ul>
        <?php foreach($products as $product) : ?>
            <li><a href="/products/<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No products found.</p>
<?php endif; ?>

<?php include srcPath("App/Views/Partials/footer.php"); ?>