<?php declare(strict_types=1);


namespace RequireOnceGenerator\ClassPath;


class ClassPath
{
    /**
     * ClassDirectory constructor.
     * @param class-string $classString
     * @param string $path
     */
    public function __construct(private string $classString, private string $path)
    {
    }

    /**
     * @return string
     */
    public function getClassString(): string
    {
        return $this->classString;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
