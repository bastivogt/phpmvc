<?php
namespace Framework;

class BaseEntity {
    // Common functionality for all entities can be added here
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->fill($data);
        }
    }
    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}