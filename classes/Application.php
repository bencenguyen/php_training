<?php

class Application {

    public function start() {
        ob_start();

        $uri = $_SERVER["REQUEST_URI"];
        $cleaned = explode("?", $uri)[0];

        $dispatcher = new Dispatcher("notFoundController");

        $dispatcher->addRoute('/php_training/', 'homeController');
        $dispatcher->addRoute('/php_training/about', 'aboutController');
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)', 'singleImageController');
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/edit', 'singleImageEditController', "POST");
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/delete', 'singleImageDeleteController', "POST");

        $dispatcher->addRoute('/php_training/login', 'loginFormController');
        $dispatcher->addRoute('/php_training/logout', 'logoutSubmitController');
        $dispatcher->addRoute('/php_training/login', 'loginSubmitController', "POST");

        list($view, $data) = $dispatcher->dispatch($cleaned);

        if (preg_match("%^redirect\:%", $view)) {
            $redirectTarget = substr($view, 9);
            header("Location:".$redirectTarget);
            die;
        }

        extract($data);
        $user = createUser();
        ob_clean();

        require_once "templates/layout.php";
    }
}