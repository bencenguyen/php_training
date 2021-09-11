<?php

class Photo {
    
    private $id;
    private $title;
    private $url;
    private $thumbnail;

    public function __construct($id, $title, $url, $thumbnail)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->thumbnail = $thumbnail;
    }
}