<?php

namespace Controllers;

class PasswordResetController
{

    private $requst;

    public function __construct(\Request $request)
    {
        $this->requst = $request;
    }

    public function show()
    {
        return [
            "reset",
            [
                "title"  => "Set your new password",
                "failed" => $this->failed(),
                "sent"   => $this->sent(),
                "token"  => $this->requst->getParams()["token"]
            ]
        ];
    }

    private function failed()
    {
        return $this->getAndDeleteFromSesseion("failed");
    }

    private function sent()
    {
        return $this->getAndDeleteFromSesseion("resetPassword");
    }

    private function getAndDeleteFromSesseion($key)
    {
        $has = $this->requst->getSession()->has($key);
        $this->requst->getSession()->remove($key);

        return $has;
    }
}
