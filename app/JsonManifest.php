<?php
namespace Otomaties\ShareButtons;

class JsonManifest
{

    private $manifest;

    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = array();
        }
    }

    public function get()
    {
        return $this->manifest;
    }
}
