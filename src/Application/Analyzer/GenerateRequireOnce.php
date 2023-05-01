<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;

use PhpParser\NodeTraverser;
use PhpParser\Parser;
use RequireOnceGenerator\Application\Analyzer\Visitor\ClassDependencyVisitor;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;

readonly class GenerateRequireOnce
{
    public function __construct(
        private Parser                   $parser,
        private GeneratorConfigInterface $config,
    )
    {
    }

    public function create(): array
    {
        $result = [];
        foreach ($this->config->getDependentClassFinder() as $file) {
            $nodeTraverser = new NodeTraverser();
            $classDependencyVisitor = new ClassDependencyVisitor();
            $filePath = $file->getPath() . '/' . $file->getFilename();
            $file = file_get_contents($filePath);
            $stmts = $this->parser->parse($file);
            $nodeTraverser->addVisitor($classDependencyVisitor);
            $nodeTraverser->traverse($stmts);

            $result[$filePath] = $classDependencyVisitor->getClasses();
        }

        return $result;
    }
}
