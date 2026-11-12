<?php
use Framework\Session;
use Framework\Message;

if (Session::has('message')) {
    $msg = Session::get('message');
    $type = $msg->getType();
    $message = $msg->getMessage();

    $color = '';
    if ($type === Message::$TYPE_SUCCESS) {
        $color = 'hsl(91, 89%, 52%)';
    } elseif ($type === Message::$TYPE_ERROR) {
        $color = 'rgb(226, 47, 47)';
    } elseif ($type === Message::$TYPE_INFO) {
        $color = 'rgb(47, 169, 226)';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $GLOBALS['settings']['app']['name'] ?> - <?php echo $title ?? ''; ?></title>
</head>
<body>
    <?php if (Session::has('message')): ?>
        <div style="background-color: <?php echo $color; ?>; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 10px;">

            <p>
                <?php echo $message; Session::remove('message'); ?>
            </p>
        </div>
    <?php endif; ?>