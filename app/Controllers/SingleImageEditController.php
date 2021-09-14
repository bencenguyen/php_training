<?php

namespace Controllers;

class SingleImageEditController
{
    public function edit($params)
    {
        $title      = $_POST["title"];
        $id         = $params["id"];
        $connection = getConnection();
        updateImage($connection, $id, $title);
        return [
            "redirect:/php_training/image/$id",
            []
        ];
    }
}
