<?php 
namespace Framework;

use Framework\View;

class BaseController {

    protected View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../App/Views');
    }

    protected function render(string $view, array $data = []): self {
        $this->view->render($view, $data);
        return $this;
    }

    // protected function render($name, $context = []) {
    //     $file = __DIR__ . "/../App/Views/$name.view.php";

    //     if (file_exists($file)) {
    //         ob_start();
    //         extract($context);
    //         require $file;
    //         $tpl = ob_get_clean();
    //         echo $tpl;
    //     } else {
    //         echo "View '$name' not found";
    //     }
    // }
}