<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer;

use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Domain\Model\Entity\FileLoadContents;
use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;

readonly class InsertRoadFunction
{
    public function __construct(
        private GeneratorConfigInterface $config,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function execute(): void
    {
        $result = [];

        /** @var array<class-string, array<string>> $classListCachePath */
        $dependList = require $this->config->getDependenciesCachePath();

        /** @var array<string, string> $classList */
        $classList = require $this->config->getClassListCachePath();

        foreach ($dependList as $class => $depends) {
            var_dump(array_search($class, $classList));

            echo (new FileLoadContents(
                $this->config->getLoadMethod(),
                new AbsolutePath(array_key_exists($class, $classList) ? $classList[$class] :  ''),
                $this->config->getLoadDirectoryPrefix(),
            ))->createPHPCode() . PHP_EOL;
        }
    }
}
