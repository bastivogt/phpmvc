<?php include srcPath("App/Views/Partials/header.php"); ?>
<h1>Product Show</h1>
<?php if(!empty($product)) : ?>
    <p><?php echo $product['name']; ?></p>
    <p><?php echo $product['description']; ?></p>
<?php else : ?>
    <p>Product not found.</p>
<?php endif; ?>

<?php include srcPath("App/Views/Partials/footer.php"); ?>