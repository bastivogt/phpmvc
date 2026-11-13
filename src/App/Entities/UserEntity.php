<?php

namespace App\Entities;
use Framework\BaseEntity;

class UserEntity extends BaseEntity {
    public $id = null;
    public $first_name = '';
    public $last_name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $is_admin = 0;


}