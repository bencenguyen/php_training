<?php

namespace Session;

interface Session extends \Storage
{
    function toArray();
}