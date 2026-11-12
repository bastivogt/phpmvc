<?php
namespace Framework;

class BaseEntity {
    // Common functionality for all entities can be added here
    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}