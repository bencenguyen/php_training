<?php

class Response {

    private $body;
    private $headers;
    private $statusCode;
    private $reasonPhrase;

    public function __construct(string $body, array $headers, int $statusCode, string $reasonPhrase)
    {
        $this->body         = $body;
        $this->headers      = $headers;
        $this->statusCode   = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
    }
}