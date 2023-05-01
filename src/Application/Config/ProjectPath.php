<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Config;

use RequireOnceGenerator\Application\Helper\StrictFunctions;

class ProjectPath
{
    /**
     * ProjectPath constructor.
     * @param string $basePath
     */
    public function __construct(private string $basePath)
    {
    }

    public static function createByCwd(): self
    {
        return new self(StrictFunctions::getcwd());
    }

    /**
     * @param string $path
     * @return string
     */
    public function basePath(string $path = ''): string
    {
        return $this->basePath.($path !== '' ? \DIRECTORY_SEPARATOR.$path : '');
    }
}
