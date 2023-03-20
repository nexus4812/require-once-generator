<?php declare(strict_types=1);


namespace RequireOnceGenerator\ClassPath;

use PhpParser\Parser;
use PhpParser\ParserFactory;
use RequireOnceGenerator\Parser\NodeFilter;

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
     * @return ClassPaths
     */
    public function create(string $path): ClassPaths
    {
        $stmts = $this->parser->parse(file_get_contents($path));

        $namespace_s = $this->nodeFilter->filterNameSpace($stmts);

        $namespace = !empty($namespace_s[0]) ?
            $namespace_s[0]->name->toString() :
            'null';

        $classes = $this->nodeFilter->filterClassLike($stmts);

        $result = [];
        foreach ($classes as $class) {
            $alias = $namespace ? $namespace . '\\' : '';
            $result[] = new ClassPath($alias. $class->name?->toString(), realpath($path));
        }

        return new ClassPaths($result);
    }
}
