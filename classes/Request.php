<?php

class Request
{
    private $body;
    private $headers;
    private $cookies;
    private $params;
    private $uri;

    public function __construct($uri, $body=null, $headers=[], $cookies=[], $params=[])
    {
        $this->uri = $uri;
        $this->body = $body;
        $this->headers = $headers;
        $this->cookies = $cookies;
        $this->params = $params;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getCookies()
    {
        return $this->cookies;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getUri()
    {
        return $this->uri;
    }
}