<?php
namespace App\Controllers;

use App\Models\TodoModel;
use Framework\Controller;
use Framework\Request;

class TodoController {

    private $model;

    public function __construct() {
        $this->model = new TodoModel();
    }

    private function getObjectOr404($id) {
        $todo = $this->model->findOne($id);
        if (!$todo) {
            notFound();
        }
        return $todo;
    }

    public function index() {
        $todos = $this->model->findAll();
        return view('Todo/index', ['title' => 'Todo Index', 'todos' => $todos]);
    }

    public function show($id) {
        $todo = $this->getObjectOr404((int)$id);
        return view('Todo/show', ['title' => 'Todo Details', 'todo' => $todo]);
    }

    public function create() {
        return view('Todo/create', [
            'title' => 'Create Todo',
            'todo' => ['title' => '', 'description' => '', 'done' => false],
            'errors' => []
        ]);
    }

    public function store() {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $done = isset($_POST['done']) ? 1 : 0;
        d($done);

        if (empty($title) || empty($description)) {
            $errors = [];
            if (empty($title)) {
                $errors[] = 'Title is required';
            }
            if (empty($description)) {
                $errors[] = 'Description is required';
            }
            return view('Todo/create', [
                'title' => 'Create Todo',
                'todo' => ['title' => $title, 'description' => $description, 'done' => $done],
                'errors' => $errors
            ]);
        }
        $this->model->create(['title' => $title, 'description' => $description, 'done' => $done]);
        redirect('/todos');
    }

    public function edit($id) {
        $todo = $this->getObjectOr404((int)$id);
        return view('Todo/edit', [
            'title' => 'Edit Todo', 
            'todo' => $todo,
            'errors' => []
        ]);
    }

    public function update($id) {
        $todo = $this->getObjectOr404((int)$id);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $done = isset($_POST['done']) ? 1 : 0;

        if (empty($title) || empty($description)) {
            $errors = [];
            if (empty($title)) {
                $errors[] = 'Title is required';
            }
            if (empty($description)) {
                $errors[] = 'Description is required';
            }
            return view('Todo/edit', [
                'title' => 'Edit Todo',
                'todo' => ['id' => $id, 'title' => $title, 'description' => $description, 'done' => $done],
                'errors' => $errors
            ]);
        }
        $this->model->update($id, ['title' => $title, 'description' => $description, 'done' => $done]);
        return redirect('/todos');
    }


    public function delete($id) {
        $todo = $this->getObjectOr404((int)$id);
        return view('Todo/delete', [
            'title' => 'Delete Todo',
            'todo' => $todo
        ]);
    }
    
    public function destroy($id) {
        $todo = $this->getObjectOr404((int)$id);
        $this->model->delete($id);
        return redirect('/todos');
    }
}