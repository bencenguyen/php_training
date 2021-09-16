<?php

namespace Controllers;

use Services\PhotoService;

class SingleImageEditController
{
    private $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function edit($params)
    {
        $title      = $_POST["title"];
        $id         = $params["id"];
        $this->photoService->updateImage($id, $title);

        return [
            "redirect:/php_training/image/$id",
            []
        ];
    }
}
