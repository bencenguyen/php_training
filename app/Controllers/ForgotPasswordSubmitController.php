<?php

namespace Controllers;

class ForgotPasswordSubmitController
{

    private $request;

    private $service;

    public function __construct(\Request $request, \Services\ForgotPasswordService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function submit()
    {
        $this->markForgotPasswordSent();
        $params = $this->request->getParams();
        $this->service->forgotPassword($params["email"]);

        return [
            "redirect:/php_training/forgotpass", []
        ];
    }

    public function markForgotPasswordSent()
    {
        $this->request->getSession()->put("sentPassword", 1);
    }
}