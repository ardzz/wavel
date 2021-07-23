<?php


namespace Ardzz\Wavel\Cores;


use Ardzz\Wavel\Cores\Handler\File;

/**
 * Class Format
 * @package Ardzz\Wavel\Cores
 */
class Format
{
    /**
     * @param string|int $number
     * @param bool $isGroup
     * @return string
     */
    static function number(string|int $number, bool $isGroup = false): string
    {
        return $isGroup ? $number : $number . '@c.us';
    }

    /**
     * @param string $filename
     * @return bool|string
     */
    static function document(string $filename): bool|string
    {
        $file = new File($filename);
        if($file->exist()){
            return sprintf("data:%s;base64,%s", $file->getMimeType(), $file->base64());
        }
        return false;
    }

    /**
     * @param string $filename
     * @return bool|string
     */
    static function image(string $filename): bool|string
    {
        $file = new File($filename);
        if($file->exist() && $file->isImage()){
            return sprintf("data:%s;base64,%s", $file->getMimeType(), $file->base64());
        }
        return false;
    }

    /**
     * @param string|array $participants participant/chat id [string (one participant), array (multiple participants)]
     * @return array|string
     */
    static function participantsGroup(string|array $participants): array|string
    {
        if (is_string($participants)){
            return self::number($participants);
        }

        return collect($participants)->map(fn ($value) => Format::number($value))->toArray();
    }
}
