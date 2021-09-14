<?php

return [
    "responseFactory" => function(ServiceContainer $container) {
        return new ResponseFactory($container->get("viewRenderer"));
    },

    "viewRenderer" => function(ServiceContainer $container) {
        return new ViewRenderer($container->get("basePath"));
    },

    "responseEmitter" => function() {
        return new ResponseEmitter();
    },

    "dispatcher" => function() {
        $dispatcher = new Dispatcher("notFoundController");

        $dispatcher->addRoute('/php_training/', 'homeController');
        $dispatcher->addRoute('/php_training/about', 'aboutController');

        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)', 'singleImageController');
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/edit', 'singleImageEditController', "POST");
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/delete', 'singleImageDeleteController', "POST");

        $dispatcher->addRoute('/php_training/login', 'loginFormController');
        $dispatcher->addRoute('/php_training/logout', 'logoutSubmitController');
        $dispatcher->addRoute('/php_training/login', 'loginSubmitController', "POST");

        return $dispatcher;
    }
];
