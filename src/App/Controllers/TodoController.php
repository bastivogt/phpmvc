<?php
namespace App\Controllers;

use App\Models\TodoModel;
use Framework\BaseController;

use App\Entities\TodoEntity;
use App;
use App\Config\Container;
use Framework\Session;
use Framework\FlashMessage;
use App\Services\FlashService;

use App\Services\ErrorService;

class TodoController extends BaseController {

    public function __construct(TodoModel $model) {
        //d('TodoController::__construct');
        parent::__construct();
        $this->model = $model;
    }

    private $model;

    // public function __construct(TodoModel $model) {
    //     $this->model = $model;
    // }

    private function getObjectOr404($id) {
        $todo = $this->model->findOne($id);
        if (!$todo) {
            notFound();
        }
        return $todo;
    }

    public function index() {
        $todos = $this->model->findAll();
        //d(App::$greeting);
        return $this->render('Todo/index', ['title' => 'Todo Index', 'todos' => $todos]);
    }

    public function show($id) {
        $todo = $this->getObjectOr404((int)$id);
        return $this->render('Todo/show', ['title' => $todo->title, 'todo' => $todo]);
    }

    public function create() {
        return $this->render('Todo/create', [
            'title' => 'Create Todo',
            'todo' => new TodoEntity()
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
            FlashService::setFlash(new FlashMessage('Please correct the errors', FlashMessage::$TYPE_ERROR));
            ErrorService::setErrors($errors); // Assuming you have an ErrorService to handle errors
            return redirect('/todos/create');
        }
        $this->model->create($todo);
        //Session::set('message', new FlashMessage('Todo created successfully', FlashMessage::$TYPE_SUCCESS));
        
        FlashService::setFlash(new FlashMessage('Todo created successfully', FlashMessage::$TYPE_SUCCESS));
        redirect('/todos');
    }

    public function edit($id) {
        $todo = $this->getObjectOr404((int)$id);
        return $this->render('Todo/edit', [
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
            FlashService::setFlash(new FlashMessage('Please correct the errors', FlashMessage::$TYPE_ERROR));
            ErrorService::setErrors($errors);
            return redirect("/todos/{$id}/edit");
        }
        $this->model->update($id, $todo);
        FlashService::setFlash(new FlashMessage('Todo updated successfully', FlashMessage::$TYPE_INFO));
        return redirect('/todos');
    }


    public function delete($id) {
        $todo = $this->getObjectOr404((int)$id);
        return $this->render('Todo/delete', [
            'title' => 'Delete Todo',
            'todo' => $todo
        ]);
    }
    
    public function destroy($id) {
        $todo = $this->getObjectOr404((int)$id);
        $this->model->delete($id);
        FlashService::setFlash(new FlashMessage('Todo deleted successfully', FlashMessage::$TYPE_ERROR));
        return redirect('/todos');
    }
}