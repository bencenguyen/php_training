<?php

class ViewRenderer
{
    public function render(ModelAndView $modelAndView)
    {
        extract($modelAndView->getModel());
        $view = $modelAndView->getViewName();

        ob_clean();
        require_once "templates/layout.php";

        return ob_get_clean();
    }
}