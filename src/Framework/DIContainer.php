<?php
namespace Framework;

use Exception;

class DIContainer {
    protected array $services = [];
    protected array $instances = [];

    public function set(string $name, callable $resolver) {
        $this->services[$name] = $resolver;
    }

    public function get(string $name) {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }
        if (!isset($this->services[$name])) {
            throw new Exception("Service not found: " . $name);
        }
        $this->instances[$name] = $this->services[$name]($this);
        return $this->instances[$name]; 
    }
}