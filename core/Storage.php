<?php

interface Storage
{
    function has($key);

    function get($key);

    function put($key);

    function remove($key);

    function clear($key);
}