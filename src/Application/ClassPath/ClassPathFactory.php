<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\ClassPath;

use PhpParser\Parser;
use RequireOnceGenerator\Application\Helper\StrictFunctions;
use RequireOnceGenerator\Application\Parser\NodeFilter;
use RuntimeException;

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
        $contents = StrictFunctions::fileGetContents($path);

        $stmts = $this->parser->parse($contents);

        if ($stmts === null) {
            return new ClassList();
        }

        $filterNameSpace = $this->nodeFilter->filterNameSpace($stmts);

        $namespace = \array_key_exists(0, $filterNameSpace) ?
            $filterNameSpace[0]->name?->toString() :
            null;

        if (\count($filterNameSpace) >= 2) {
            throw new RuntimeException('Multiple namespaces are set for a single file. path:' . $path);
        }

        $classes = $this->nodeFilter->filterClassLike($stmts);

        $result = [];
        foreach ($classes as $class) {
            if ($class->name === null) {
                continue;
            }
            $alias = $namespace !== null ? $namespace . '\\' : '';

            /** @var class-string $classString */
            $classString = $alias . $class->name->toString();
            $result[] = new ClassPath($classString, StrictFunctions::realpath($path));
        }

        return new ClassList($result);
    }
}
