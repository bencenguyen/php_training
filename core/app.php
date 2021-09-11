<?php

ob_start();

$uri = $_SERVER["REQUEST_URI"];
$cleaned = explode("?", $uri)[0];
route('/php-basics-materials/', 'homeController');
route('/php-basics-materials/about', 'aboutController');
route('/php-basics-materials/image/(?<id>[\d]+)', 'singleImageController');
route('/php-basics-materials/image/(?<id>[\d]+)/edit', 'singleImageEditController', "POST");
route('/php-basics-materials/image/(?<id>[\d]+)/delete', 'singleImageDeleteController', "POST");

route('/php-basics-materials/login', 'loginFormController');
route('/php-basics-materials/logout', 'logoutSubmitController');
route('/php-basics-materials/login', 'loginSubmitController', "POST");

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
