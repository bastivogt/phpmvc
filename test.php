<?php

class TestModel {
    public function __construct() {
        echo "TestModel instantiated";
    }

    public function getMessage() {
        return "Hello from TestModel";
    }
}



class TestController {
    public function __construct(private TestModel $model) {
        echo "TestController instantiated";
        echo $this->model->getMessage();
    }
}



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

$container = new DIContainer();
$container->set(TestModel::class, function($container) {
    return new TestModel();
});
$container->set(TestController::class, function($container) {
    return new TestController($container->get(TestModel::class));
});

$controller = $container->get(TestController::class);