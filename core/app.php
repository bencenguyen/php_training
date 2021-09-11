<?php

ob_start();

$uri = $_SERVER["REQUEST_URI"];
$cleaned = explode("?", $uri)[0];
route('/php_training/', 'homeController');
route('/php_training/about', 'aboutController');
route('/php_training/image/(?<id>[\d]+)', 'singleImageController');
route('/php_training/image/(?<id>[\d]+)/edit', 'singleImageEditController', "POST");
route('/php_training/image/(?<id>[\d]+)/delete', 'singleImageDeleteController', "POST");

route('/php_training/login', 'loginFormController');
route('/php_training/logout', 'logoutSubmitController');
route('/php_training/login', 'loginSubmitController', "POST");

list($view, $data) = dispatch($cleaned, 'notFoundController');

if(preg_match("%^redirect\:%", $view)) {
    $redirectTarget = substr($view, 9);
    header("Location:".$redirectTarget);
    die;
}

extract($data);
$user = createUser();
ob_clean();

require_once "templates/layout.php";
