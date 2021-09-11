<?php

class Photo {
    
    public $id;
    public $title;
    public $url;
    public $thumbnail;

    public function __construct($id, $title, $url, $thumbnail)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->thumbnail = $thumbnail;
    }
}