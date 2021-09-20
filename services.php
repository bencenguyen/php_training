<?php

use Exception\SqlException;
use Session\SessionFactory;
use Middleware\MiddlewareStack;
use Middleware\DispatchingMiddleware;
use Middleware\AuthorizationMiddleware;

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
        return new Services\AuthService($container->get("connection"), $container->get("session"));
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

    "loginFormController" => function(ServiceContainer $container) {
        return new Controllers\LoginFormController($container->get("session"));
    },

    "loginSubmitController" => function(ServiceContainer $container) {
        return new Controllers\LoginSubmitController($container->get("authService"), $container->get("session"));
    },

    "logoutSubmitController" => function(ServiceContainer $container) {
        return new Controllers\LogoutSubmitController($container->get("authService"));
    },

    "notFoundController" => function() {
        return new Controllers\NotFoundController();
    },

    "forgotPasswordController" => function(ServiceContainer $container) {
        return new Controllers\NotFoundController($container->get("session"));
    },

    "forgotPasswordSubmitController" => function(ServiceContainer $container) {
        return new Controllers\NotFoundController($container->get("session"));
    },

    "session" => function(ServiceContainer $container) {
        $sessionConfig = $container->get("config")["session"];
        return SessionFactory::build($sessionConfig["driver"], $sessionConfig["config"]);
    },

    "request" => function(ServiceContainer $container) {
        return new Request($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], $container->get("session"), file_get_contents("php://input"), getallheaders(), $_COOKIE, $_POST);
    },

    "mailer" => function(ServiceContainer $container) {
        $mailConfig = $container->get("config")["mail"];
        $transport = (new Swift_SmtpTransport($mailConfig["host"], $mailConfig["port"]))
            ->setUsername($mailConfig["username"])
            ->setPassword($mailConfig["password"]);

            return new Swift_Mailer($transport);
    },

    "pipeline" => function(ServiceContainer $container) {
        $pipeline = new MiddlewareStack();

        $authMiddleware = new AuthorizationMiddleware(["/php_training/"], $container->get("authService"), "/php_training/login");
        $dispatcherMiddleware = new DispatchingMiddleware($container->get("dispatcher"), $container->get("responseFactory"));
        
        $pipeline->addMiddleware($authMiddleware);
        $pipeline->addMiddleware($dispatcherMiddleware);

        return $pipeline;
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

        $dispatcher->addRoute('/php_training/login', 'forgotPasswordController@show');
        $dispatcher->addRoute('/php_training/login', 'forgotPasswordSubmitController@submit', "POST");

        return $dispatcher;
    }
];
