<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Config;

use RequireOnceGenerator\Domain\Model\ValueObject\LoadDirectoryPrefix;
use RequireOnceGenerator\Domain\Model\ValueObject\LoadMethod;
use Symfony\Component\Finder\Finder;

interface GeneratorConfigInterface
{
    /**
     * ".rog-class-list.cache"'s path
     *
     * @return string
     */
    public function getClassListCachePath(): string;


    /**
     * @return string
     */
    public function getDependenciesCachePath();

    /**
     * Require once target files
     *
     * @return Finder
     */
    public function getDependentClassFinder(): Finder;

    /**
     * @return Finder
     */
    public function getTargetFinder(): Finder;


    public function getLoadMethod(): LoadMethod;


    public function getLoadDirectoryPrefix(): null|LoadDirectoryPrefix;
}
