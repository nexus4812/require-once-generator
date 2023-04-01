<?php declare(strict_types=1);


namespace RequireOnceGenerator\Config;


class ProjectPath
{
    /**
     * ProjectPath constructor.
     * @param string $basePath
     */
    public function __construct(private string $basePath)
    {
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
