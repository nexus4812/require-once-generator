<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\ClassPath;


class ClassList
{
    /**
     * ClassPaths constructor.
     * @param ClassPath[] $paths
     */
    public function __construct(private array $paths = [])
    {
    }

    public function merge(self $paths): void
    {
        foreach ($paths->all() as $path) {
            $this->paths[] = $path;
        }
    }

    /**
     * @return ClassPath[]
     */
    public function all(): array
    {
        return $this->paths;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->all() as $path) {
            $result[$path->getClassString()] = $path->getPath();
        }

        return $result;
    }
}
