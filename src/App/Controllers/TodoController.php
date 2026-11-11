<?php
namespace App\Controllers;

use App\Models\TodoModel;
use Framework\Controller;
use Framework\Request;
use App\Entities\TodoEntity;
use App;

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
        d(App::$greeting);
        return view('Todo/index', ['title' => 'Todo Index', 'todos' => $todos]);
    }

    public function show($id) {
        $todo = $this->getObjectOr404((int)$id);
        return view('Todo/show', ['title' => $todo->title, 'todo' => $todo]);
    }

    public function create() {
        return view('Todo/create', [
            'title' => 'Create Todo',
            'todo' => new TodoEntity(),
            'errors' => []
        ]);
    }

    public function store() {
        $todo = new TodoEntity();
        $todo->fill($_POST);
        $todo->done = isset($_POST['done']) ? 1 : 0;

        if (empty($todo->title) || empty($todo->description)) {
            $errors = [];
            if (empty($todo->title)) {
                $errors[] = 'Title is required';
            }
            if (empty($todo->description)) {
                $errors[] = 'Description is required';
            }
            return view('Todo/create', [
                'title' => 'Create Todo',
                'todo' => $todo,
                'errors' => $errors
            ]);
        }
        $this->model->create($todo);
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
        $todo->fill($_POST);
        $todo->done = isset($_POST['done']) ? 1 : 0;

        if (empty($todo->title) || empty($todo->description)) {
            $errors = [];
            if (empty($todo->title)) {
                $errors[] = 'Title is required';
            }
            if (empty($todo->description)) {
                $errors[] = 'Description is required';
            }
            return view('Todo/edit', [
                'title' => 'Edit Todo',
                'todo' => $todo,
                'errors' => $errors
            ]);
        }
        $this->model->update($id, $todo);
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