<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;

use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Application\Parser\NodeCollectionFactory;
use RequireOnceGenerator\Domain\Model\Entity\FileDependencyInfo;
use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;
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
                if (\array_key_exists($name->toString(), $class)) {
                    $requireOnceInfo->addRequireOnce($class[$name->toString()]);
                    continue;
                }

                # Append same name space class
                if($namespace) { /** @phpstan-ignore-line */
                    $className = $namespace.'\\'. $name->toCodeString();
                    if (\array_key_exists($className, $class)) {
                        $requireOnceInfo->addRequireOnce($class[$className]);
                    }
                }
            }
            var_dump($requireOnceInfo->toArray());
        }
    }
}
