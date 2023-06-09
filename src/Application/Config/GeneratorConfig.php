<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Config;

use RequireOnceGenerator\Domain\Model\ValueObject\LoadDirectoryPrefix;
use RequireOnceGenerator\Domain\Model\ValueObject\LoadMethod;
use Symfony\Component\Finder\Finder;

readonly class GeneratorConfig implements GeneratorConfigInterface
{
    /**
     * @param ProjectPath $path
     */
    public function __construct(private ProjectPath $path)
    {
    }

    /**
     * @inheritDoc
     */
    public function getClassListCachePath(): string
    {
        return $this->path->basePath('.rog-class-list.cache');
    }

    /**
     * @inheritDoc
     */
    public function getDependenciesCachePath(): string
    {
        return $this->path->basePath('.rog-dependencies.cache');
    }

    /**
     * @inheritDoc
     */
    public function getDependentClassFinder(): Finder
    {
        return Finder::create()->in(
            [
                $this->path->basePath('src'),
            ]
        )->name('*.php');
    }

    /**
     * @inheritDoc
     */
    public function getTargetFinder(): Finder
    {
        return Finder::create()->in($this->path->basePath('src'))->name('*.php');
    }

    public function getLoadMethod(): LoadMethod
    {
        return LoadMethod::REQUIRE_ONCE;
    }

    public function getLoadDirectoryPrefix(): null|LoadDirectoryPrefix
    {
        return null;
    }
}
