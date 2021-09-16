<?php

namespace Controllers;

class loginFormController
{
    public function show()
    {
        $containsError = $this->checkForError();

        return [
            "login", [
                "title"         => "Login",
                "containsError" => $containsError
            ]
        ];
    }

    private function checkForError() 
    {
        $containsError = array_key_exists("containsError", $_SESSION);
        unset($_SESSION["containsError"]);

        return $containsError;
    }
}
