<?php

namespace Controllers;

class loginFormController
{
    function show()
    {
        $containsError = array_key_exists("containsError", $_SESSION);
        unset($_SESSION["containsError"]);

        return [
            "login", [
                "title"         => "Login",
                "containsError" => $containsError
            ]
        ];
    }
}