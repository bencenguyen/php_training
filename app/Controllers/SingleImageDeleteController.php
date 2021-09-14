<?php

namespace Controllers;

class SingleImageDeleteController
{
    public function delete($params)
    {
        $connection = getConnection();
        deleteImage($connection, $params["id"]);
        return [
            "redirect:/php_training",
            []
        ];
    }
}
