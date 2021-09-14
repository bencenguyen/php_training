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

    "homeController" => function() {
        return new Controllers\HomeController();
    },

    "singleImageController" => function() {
        return new Controllers\SingleImageController();
    },

    "singleImageEditController" => function() {
        return new Controllers\SingleImageEditController();
    },

    "singleImageDeleteController" => function() {
        return new Controllers\SingleImageDeleteController();
    },

    "loginFormController" => function() {
        return new Controllers\LoginFormController();
    },

    "loginSubmitController" => function() {
        return new Controllers\LoginSubmitController();
    },

    "logoutSubmitController" => function() {
        return new Controllers\LogoutSubmitController();
    },

    "dispatcher" => function(ServiceContainer $container) {
        $dispatcher = new Dispatcher($container, "notFoundController");

        $dispatcher->addRoute('/php_training/', 'homeController@handle');

        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)', 'singleImageController@display');
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/edit', 'singleImageEditController@edit', "POST");
        $dispatcher->addRoute('/php_training/image/(?<id>[\d]+)/delete', 'singleImageDeleteController@delete', "POST");

        $dispatcher->addRoute('/php_training/login', 'loginFormController@show');
        $dispatcher->addRoute('/php_training/logout', 'logoutSubmitController@submit');
        $dispatcher->addRoute('/php_training/login', 'loginSubmitController@submit', "POST");

        return $dispatcher;
    }
];
