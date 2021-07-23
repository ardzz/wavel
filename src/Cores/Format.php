<?php


namespace Ardzz\Wavel\Cores;


use Ardzz\Wavel\Cores\Handler\File;

class Format
{
    static function number(string|int $number, bool $isGroup = false): string
    {
        return $isGroup ? $number : $number . '@c.us';
    }

    static function document(string $filename): bool|string
    {
        $file = new File($filename);
        if($file->exist()){
            return sprintf("data:%s;base64,%s", $file->getMimeType(), $file->base64());
        }
        return false;
    }

    static function image(string $filename): bool|string
    {
        $file = new File($filename);
        if($file->exist() && $file->isImage()){
            return sprintf("data:%s;base64,%s", $file->getMimeType(), $file->base64());
        }
        return false;
    }

    static function participantsGroup(string|array $participants): array|string
    {
        if (is_string($participants)){
            return self::number($participants);
        }

        return collect($participants)->map(fn ($value) => Format::number($value))->toArray();
    }
}
