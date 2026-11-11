<?php

namespace App\Entities;

use DateTime;

class TodoEntity {
    public ?int $id = null;
    public string $description = '';
    public string $title = '';
    public bool $done = false;
    public string $created_at = '';
    public string $updated_at = '';

    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }


}