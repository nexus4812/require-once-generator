<?php declare(strict_types=1);

namespace RequireOnceGenerator\Application\Config;

use Symfony\Component\Finder\Finder;

class GeneratorConfig implements GeneratorConfigInterface
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
        return $this->path->basePath('.require-once-generator.cache');
    }

    /**
     * @inheritDoc
     */
    public function getDependentClassFinder(): Finder
    {
        return Finder::create()->in(
            [
                $this->path->basePath('src'),
                $this->path->basePath('domain'),
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
}
