<?php
namespace Otomaties\ShareButtons;

class JsonManifest
{

    private $manifest;

    public function __construct($manifestPath)
    {
        if (file_exists($manifestPath)) {
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        } else {
            $this->manifest = [];
        }
    }

    public function get()
    {
        return $this->manifest;
    }
}
