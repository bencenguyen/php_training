<?php

namespace Session;

class FileSession implements Session
{

    private $filename;
    private $data;

    public function __construct(array $config)
    {
        $folder = $config["folder"];
        $id = session_id();
        $this->filename = $folder . DIRECTORY_SEPARATOR . $id;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->getData());
    }

    public function get($key)
    {   
        return $this->getData()[$key];
    }

    public function put($key, $value)
    {
        $this->getData();
        $this->data[$key] = $value;
        $this->persist();
    }

    public function remove($key)
    {
        $this->getData();
        unset($this->data[$key]);
        $this->persist();
    }

    public function clear()
    {
        $this->data = [];
        $this->persist();
    }

    private function getData() 
    {
        if ($this->data == null) {
            if (file_exists($this->filename)) {
                $this->data = unserialize(file_get_contents($this->filename));
            } else $this->data = [];
        }

        return $this->data;
    }

    private function persist()
    {
        if (!file_put_contents($this->filename, serialize($this->data))) {
            throw new \Exception("Can't write file" . $this->filename);
        }
    }
    
    public function toArray()
    {
        return $this->getData();
    }
}