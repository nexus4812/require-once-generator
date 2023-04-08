<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Helper;

use RuntimeException;

class StrictFunctions
{
    public static function fileGetContents(string $filename): string
    {
        $result = file_get_contents($filename);
        if ($result === false) {
            throw new RuntimeException("file_get_contents return is false");
        }

        return $result;
    }

    public static function realpath(string $filename): string
    {
        $result = realpath($filename);
        if ($result === false) {
            throw new RuntimeException("realpath return is false");
        }

        return $result;
    }

    public static function getcwd(): string
    {
        $result = getcwd();
        if ($result === false) {
            throw new RuntimeException("getcwd return is false");
        }

        return $result;

    }
}
