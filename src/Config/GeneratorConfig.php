<?php

namespace RequireOnceGenerator\Config;

use Symfony\Component\Finder\Finder;

class GeneratorConfig implements GeneratorConfigInterface
{
    /**
     * RequireOnceGeneratorConfig constructor.
     */
    public function __construct(private ProjectPath $path)
    {
    }

    /**
     * @return string
     */
    public function getClassListCachePath(): string
    {
        return $this->path->basePath('.require-once-generator.cache');
    }

    public function getDependentClassFinder(): Finder
    {
        return Finder::create()->in($this->path->basePath('vendor'))->name('*.php');
    }
}
