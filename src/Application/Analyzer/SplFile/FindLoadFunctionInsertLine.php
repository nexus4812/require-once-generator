<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer\SplFile;

use InvalidArgumentException;
use SplFileObject;

class FindLoadFunctionInsertLine
{
    public function countRequireOnceLine(string $filename): int
    {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException("File not found: $filename");
        }

        $file = new SplFileObject($filename);
        $requireOnceLine = 0;

        while (!$file->eof()) {
            /** @var string $line */
            $line = $file->fgets();
            $requireOnceLine++;

            if (str_contains($line, 'require_once') || str_contains($line, 'include_once')) {
                return $requireOnceLine;
            }
        }

        return 1;
    }
}
