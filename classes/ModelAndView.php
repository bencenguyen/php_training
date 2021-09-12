<?php

final class ModelAndView
{

    private $viewName;
    private $model;

    public function __construct(string $viewName, array $model = [])
    {
        $this->viewName = $viewName;
        $this->model    = $model;
    }

    public function getViewName()
    {
        return $this->viewName;
    }

    public function getModel()
    {
        return $this->model;
    }
}