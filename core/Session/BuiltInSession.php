<?php

namespace Session;

class BuiltInSession implements Session
{

    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function get($key)
    {   
        return $_SESSION[$key];
    }

    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function clear()
    {
        unset($_SESSION);
    }

    public function toArray()
    {
        return $_SESSION;
    }
}