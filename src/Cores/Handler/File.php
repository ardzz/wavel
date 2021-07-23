<?php


namespace Ardzz\Wavel\Cores\Handler;


class File
{
    function __construct(private String $file)
    {
    }

    function getFile(): string
    {
        return $this->file;
    }

    function read(): bool|string
    {
        return $this->exist() ? file_get_contents($this->getFile()) : false;
    }

    function exist(): bool
    {
        return file_exists($this->getFile());
    }

    function getMimeType(): bool|string
    {
        return mime_content_type($this->getFile());
    }

    function isImage(): bool
    {
        if ($this->exist()){
            try {
                $image = getimagesize($this->getFile());
                $allowed = [IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP];
                return $image && in_array($image[2], $allowed);
            }
            catch (\Exception){
                return false;
            }
        }
        return false;
    }

    function base64(): string
    {
        return base64_encode($this->read());
    }
}
