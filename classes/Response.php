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

    public function getBody() {
        return $this->body;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }
}