<?php $this->extend("Layouts/default"); ?>
<?php $this->section("title"); ?>
    <?php echo $title; ?>
<?php $this->endSection(); ?>

<?php $this->section("content"); ?>
    <h1><?php echo $title; ?></h1>
<?php $this->endSection(); ?>