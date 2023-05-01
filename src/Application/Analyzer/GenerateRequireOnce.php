<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer;

use RequireOnceGenerator\Application\Analyzer\Reflector\ClassDependencyAnalyzer;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;

readonly class GenerateRequireOnce
{
    public function __construct(
        private ClassDependencyAnalyzer                   $analyzer,
        private GeneratorConfigInterface $config,
    ) {
    }

    public function create(): void
    {
        $result = [];

        $classListCachePath = $this->config->getClassListCachePath();

        /** @var array<string, string> $classListCachePath1 */
        $classListCachePath = require $classListCachePath;

        foreach ($classListCachePath as $class => $directory) {
            $result[$class] = $this->analyzer->getClassDependencies(new \ReflectionClass($class));
        }

        $array = var_export($result, true);
        file_put_contents($this->config->getDependenciesCachePath(), "<?php return {$array}; ?>");
    }
}
