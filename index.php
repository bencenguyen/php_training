<?php

declare(strict_types=1);

session_start();
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once "classes/Photo.php";
require_once "core/config.php";
require_once "core/functions.php";
require_once "core/controllers.php";
require_once "classes/Dispatcher.php";
require_once "classes/Application.php";
require_once "classes/Response.php";
require_once "classes/ResponseEmitter.php";
require_once "classes/ResponseFactory.php";
require_once "classes/ViewRenderer.php";
require_once "classes/ModelAndView.php";

(new Application())->start();
