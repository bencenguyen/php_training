<?php

use Exception\SqlException;


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

    "homeController" => function(ServiceContainer $container) {
        return new Controllers\HomeController($container->get("photoService"));
    },

    "config" => function(ServiceContainer $container) {
        $base = $container->get("basePath");
        return include_once($base . "/config.php");
    },

    "connection" => function(ServiceContainer $container) {
        $config = $container->get("config");
        $connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

        if (!$connection) {
            throw new SqlException('Connection error');
        }

        return $connection;
    },

    "photoService" => function(ServiceContainer $container) {
        return new Services\PhotoService($container->get("connection"));
    },

    "authService" => function(ServiceContainer $container) {
        return new Services\AuthService($container->get("connection"));
    },

    "singleImageController" => function(ServiceContainer $container) {
        return new Controllers\SingleImageController($container->get("photoService"));
    },

    "singleImageEditController" => function(ServiceContainer $container) {
        return new Controllers\SingleImageEditController($container->get("photoService"));
    },

    "singleImageDeleteController" => function(ServiceContainer $container) {
        return new Controllers\SingleImageDeleteController($container->get("photoService"));
    },

    "loginFormController" => function() {
        return new Controllers\LoginFormController();
    },

    "loginSubmitController" => function(ServiceContainer $container) {
        return new Controllers\LoginSubmitController($container->get("authService"));
    },

    "logoutSubmitController" => function(ServiceContainer $container) {
        return new Controllers\LogoutSubmitController($container->get("authService"));
    },

    "notFoundController" => function() {
        return new Controllers\NotFoundController();
    },

    "dispatcher" => function(ServiceContainer $container) {
        $dispatcher = new Dispatcher($container, "notFoundController@handle");

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
