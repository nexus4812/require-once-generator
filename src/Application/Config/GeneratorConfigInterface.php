<?php declare(strict_types=1);

namespace RequireOnceGenerator\Application\Config;

use Symfony\Component\Finder\Finder;

interface GeneratorConfigInterface
{
    /**
     * ".require-once-generator.cache"'s path
     *
     * @return string
     */
    public function getClassListCachePath(): string;

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
}
