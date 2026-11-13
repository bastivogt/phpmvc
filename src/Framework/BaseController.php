<?php 
namespace Framework;

class BaseController {

    protected function render($name, $context = []) {
        $file = __DIR__ . "/../App/Views/$name.view.php";

        if (file_exists($file)) {
            ob_start();
            extract($context);
            require $file;
            $tpl = ob_get_clean();
            echo $tpl;
        } else {
            echo "View '$name' not found";
        }
    }
}