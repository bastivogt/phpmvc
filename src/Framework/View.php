<?php

namespace Framework;

use RuntimeException;

class View
{
    private ?string $layout = null;
    private array $sections = [];
    private ?string $currentSection = null;
    private string $viewDir;

    public function __construct(string $viewDir)
    {
        $this->viewDir = $viewDir;
    }

    public function extend(string $layout): void
    {
        $this->layout = $layout;
    }

    public function section(string $name): void
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function endSection(): void
    {
        if ($this->currentSection === null) {
            throw new RuntimeException('No section is currently being captured.');
        }
        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = null;
    }   

    public function renderSection(string $name): string
    {
        if (!isset($this->sections[$name])) {
            throw new RuntimeException("Section '$name' not found.");
        }
        return $this->sections[$name];
    }

    public function render(string $view, array $data = []): string
    {
        extract($data);
        $viewFile = $this->viewDir . '/' . $view  . '.view' . '.php';
        d($viewFile);
        if (!file_exists($viewFile)) {
            throw new RuntimeException("View file '$viewFile' not found.");
        }
        ob_start();
        include $viewFile;
        $content = ob_get_clean();
        if ($this->layout !== null) {
            $layoutFile = $this->viewDir . '/' . $this->layout . '.view' . '.php';
            if (!file_exists($layoutFile)) {
                throw new RuntimeException("Layout file '$layoutFile' not found.");
            }
            ob_start();
            include $layoutFile;
            $content = ob_get_clean();
        }
        return $content;    
    }

    public function include(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = $this->viewDir . '/' . $view  . '.view' . '.php';
        if (!file_exists($viewFile)) {
            throw new RuntimeException("View file '$viewFile' not found.");
        }
        include $viewFile;
    }
}