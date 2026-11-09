<?php getPartial('Partials/header', ['title' => 'Delete Product']); ?>
<h1>Delete Product</h1>
<p>Are you sure you want to delete the product "<?php echo esc($product['name']) ?? ''; ?>"?</p>
<form action="/products/<?php echo $product['id'] ?? ''; ?>/delete" method="post">
    <button type="submit">Yes, Delete</button>
    <a href="<?php echo previousUrl(); ?>">Cancel</a>
</form>
<?php getPartial('Partials/footer'); ?> 