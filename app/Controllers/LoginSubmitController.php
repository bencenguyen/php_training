<?php

namespace Controllers;

use Session\Session;
use Services\AuthService;

class LoginSubmitController
{

    private $authService;

    private $session;

    public function __construct(AuthService $authService, Session $session)
    {
        $this->authService = $authService;
        $this->session = $session;
    }
    
    public function submit()
    {
        $password = trim($_POST["password"]);
        $email    = trim($_POST["email"]);
        $success     = $this->authService->loginUser($email, $password);

        if ($success) {
            $view = "redirect:/php_training";
        } else {
            $this->markAsLoginFailed();
            $view = "redirect:/php_training/login";
        }

        return [
            $view, []
        ];
    }

    private function markAsLoginFailed()
    {
        $this->session->put("containsError", 1);
    }
}
