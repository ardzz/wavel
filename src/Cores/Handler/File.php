<?php


namespace Ardzz\Wavel\Cores\Handler;


/**
 * Class File
 * @package Ardzz\Wavel\Cores\Handler
 */
class File
{
    /**
     * File constructor.
     * @param String $file Full path of the file
     */
    function __construct(private String $file)
    {
    }

    /**
     * Get path file
     * @return string
     */
    function getFile(): string
    {
        return $this->file;
    }

    /**
     * Read the file
     * @return bool|string
     */
    function read(): bool|string
    {
        return $this->exist() ? file_get_contents($this->getFile()) : false;
    }

    /**
     * Check file is exist or not
     * @return bool
     */
    function exist(): bool
    {
        return file_exists($this->getFile());
    }

    /**
     * Get mime type of file
     * @return bool|string
     */
    function getMimeType(): bool|string
    {
        return mime_content_type($this->getFile());
    }

    /**
     * Check if file is image or not
     * @return bool
     */
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

    /**
     * Convert content of file to base64
     * @return string
     */
    function base64(): string
    {
        return base64_encode($this->read());
    }
}
