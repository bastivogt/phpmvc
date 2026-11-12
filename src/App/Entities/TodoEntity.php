<?php

namespace App\Entities;

use Framework\BaseEntity;

use DateTime;

class TodoEntity extends BaseEntity {
    public ?int $id = null;
    public string $description = '';
    public string $title = '';
    public bool $done = false;
    public string $created_at = '';
    public string $updated_at = '';



}