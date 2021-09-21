<?php

namespace Controllers;

use Session\Session;

class ForgotPasswordController
{

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function show()
    {
        return [
            "forgotpass",
            [
                "sent"  => $this->sent(),
                "title" => "Forgot password"
            ]
        ];
    }

    public function sent()
    {
        $sentPassword = $this->session->has("sentPassword");
        $this->session->remove("sentPassword");

        return $sentPassword;
    }
}
