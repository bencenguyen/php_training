<?php

namespace Session;


class SessionFactory
{

    public static function build($driver, array $config)
    {
        switch ($driver) {
            case "file":
                return new FileSession($config);
                break;
            case "default":
                return new BuiltInSession();
                break;
            default:
                throw new \Exception("No driver found for key" . $driver);
        }
        return new BuiltInSession();
    }
}
