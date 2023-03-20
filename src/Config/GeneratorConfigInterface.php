<?php

namespace RequireOnceGenerator\Config;

use Symfony\Component\Finder\Finder;

interface GeneratorConfigInterface
{
    /**
     * @return string
     */
    public function getClassListCachePath(): string;

    /**
     * @return Finder
     */
    public function getDependentClassFinder(): Finder;
}
