<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;

use RequireOnceGenerator\Application\ClassPath\ClassPathFactory;
use RequireOnceGenerator\Application\ClassPath\ClassList;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use SplFileInfo;

readonly   class GenerateClassList
{
    public function __construct(
        private ClassPathFactory $pathFactory,
        private GeneratorConfigInterface $config
    )
    {
    }

    public function create(): void
    {
        $classPaths = new ClassList();

        /** @var SplFileInfo $file */
        foreach ($this->config->getDependentClassFinder() as $file) {
            $filePath = $file->getPath(). '/'. $file->getFilename();
            $classPaths->merge($this->pathFactory->create($filePath));
        }

        $array = var_export($classPaths->toArray(), true);
        file_put_contents($this->config->getClassListCachePath(), "<?php return {$array}; ?>");
    }
}
