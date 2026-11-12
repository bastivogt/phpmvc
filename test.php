<?php

$password = 'Function7';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;