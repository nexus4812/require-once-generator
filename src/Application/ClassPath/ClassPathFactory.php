<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\ClassPath;

use PhpParser\Parser;
use RequireOnceGenerator\Application\Parser\NodeFilter;
use RuntimeException;
use function count;

class ClassPathFactory
{
    /**
     * ClassPathFactory constructor.
     * @param Parser $parser
     * @param NodeFilter $nodeFilter
     */
    public function __construct(
        private Parser $parser,
        private NodeFilter $nodeFilter
    )
    {
    }

    /**
     * @param string $path
     * @return ClassList
     */
    public function create(string $path): ClassList
    {
        $stmts = $this->parser->parse(file_get_contents($path) ?: '');

        if ($stmts === null) {
            return new ClassList();
        }

        $filterNameSpace = $this->nodeFilter->filterNameSpace($stmts);

        $namespace = !empty($filterNameSpace[0]) ?
            $filterNameSpace[0]->name?->toString() :
            null;

        if (\count($filterNameSpace) >= 2) {
            throw new RuntimeException('Multiple namespaces are set for a single file. path:' . $path);
        }

        $classes = $this->nodeFilter->filterClassLike($stmts);

        $result = [];
        foreach ($classes as $class) {
            if (empty($class->name)) {
                continue;
            }
            $alias = $namespace ? $namespace . '\\' : '';

            /** @var class-string $classString */
            $classString = $alias . $class->name->toString();
            $result[] = new ClassPath($classString, realpath($path) ?: '');
        }

        return new ClassList($result);
    }
}
