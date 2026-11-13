<?php
use Framework\Session;
use Framework\FlashMessage;
use App\Services\FlashService;

if (FlashService::hasFlash()) {
    d("Flash exists");
    $flash = FlashService::getFlash();
    $type = $flash->getType();
    $message = $flash->getMessage();

    d("Flash type: $type, message: $message");
    $color = '';
    if ($type === FlashMessage::$TYPE_SUCCESS) {
        $color = '#81f218';
    } elseif ($type === FlashMessage::$TYPE_ERROR) {
        $color = '#e22f2f';
    } elseif ($type === FlashMessage::$TYPE_INFO) {
        $color = '#2fa9e2';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php echo $this->renderSection('styles'); ?>
    <title>PHP MVC - <?php echo $this->renderSection('title'); ?></title>
</head>
<body>
    
    <?php if (isset($message)): ?>
        <div style="background-color: <?php echo $color; ?>; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 10px;">
            <p>
                <?php echo $message; ?>
            </p>
        </div>
    <?php endif; ?>
    <header>
        <?php $this->include('Includes/nav-meta'); ?>
    </header>
    <div><?php echo $this->renderSection('content'); ?></div>


    <script src="/assets/js/app.js"></script>
    <?php echo $this->renderSection('scripts'); ?>
</body>
</html>