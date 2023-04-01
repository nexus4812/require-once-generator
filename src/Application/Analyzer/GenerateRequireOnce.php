<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;

use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Application\Parser\NodeCollectionFactory;
use RequireOnceGeneratorDomain\Entity\FileDependencyInfo;
use RequireOnceGeneratorDomain\ValueObject\AbsolutePath;
use SplFileInfo;

class GenerateRequireOnce
{
    public function __construct(
        private GeneratorConfigInterface $config,
        private NodeCollectionFactory $nodesFactory
    )
    {
    }

    public function create(): void
    {
        $class = require $this->config->getClassListCachePath();

        /** @var SplFileInfo $file */
        foreach ($this->config->getTargetFinder() as $file) {
            $absolutePath = AbsolutePath::createFromSplFileInfo($file);
            $nodes = $this->nodesFactory->createFromAbsolutePath($absolutePath);
            $namespace = $nodes->findNameSpace()?->name?->toString();

            $requireOnceInfo = FileDependencyInfo::createWithEmpty($absolutePath);
            foreach ($nodes->filterName() as $name) {
                # Append other Namespace class
                if (!empty($class[$name->toString()])) {
                    $requireOnceInfo->addRequireOnce($class[$name->toString()]);
                    continue;
                }

                # Append same name space class
                if($namespace) {
                    $className = $namespace.'\\'. $name->toCodeString();
                    if (!empty($class[$className])) {
                        $requireOnceInfo->addRequireOnce($class[$className]);
                    }
                }
            }
            var_dump($requireOnceInfo->toArray());
        }
    }
}
