<?php declare(strict_types=1);


namespace RequireOnceGenerator\Analyzer;

use RequireOnceGenerator\ClassPath\ClassPathFactory;
use RequireOnceGenerator\ClassPath\ClassPaths;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class GenerateClassPath
{
    /**
     * GenerateClassPath constructor.
     * @param ClassPathFactory $pathFactory
     */
    public function __construct(private ClassPathFactory $pathFactory)
    {
    }

    public function create(string $absolutePath, $patterns = ['*.php']): ClassPaths
    {
        $finder = Finder::create()->in($absolutePath)->name($patterns)->files();

        $classPaths = new ClassPaths();

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $filePath = $file->getPath(). '/'. $file->getFilename();
            $classPaths->merge($this->pathFactory->create($filePath));
        }

        var_export($classPaths->toArray());

        return $classPaths;
    }
}
