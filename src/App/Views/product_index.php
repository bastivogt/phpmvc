<?php include 'header.php'; ?>
    <h1>Products</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo esc($product['name']) . ' - ' . esc($product['description']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php include 'footer.php'; ?>