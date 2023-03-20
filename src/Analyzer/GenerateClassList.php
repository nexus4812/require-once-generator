<?php declare(strict_types=1);


namespace RequireOnceGenerator\Analyzer;

use RequireOnceGenerator\ClassPath\ClassPathFactory;
use RequireOnceGenerator\ClassPath\ClassList;
use RequireOnceGenerator\Config\GeneratorConfigInterface;
use SplFileInfo;

class GenerateClassList
{
    /**
     * GenerateClassPath constructor.
     * @param ClassPathFactory $pathFactory
     * @param GeneratorConfigInterface $config
     */
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
