<?php declare(strict_types=1);


namespace RequireOnceGenerator\Parser;


use PhpParser\Parser;
use RequireOnceGeneratorDomain\ValueObject\AbsolutePath;

class NodeCollectionFactory
{
    public function __construct(
        private NodeFilter $filter,
        private Parser $parser
    )
    {
    }

    public function createFromRawFile(string $rawCode): NodeCollection
    {
        $stmts = $this->parser->parse($rawCode);
        if (null === $stmts) {
            throw new \RuntimeException('parse return is null');
        }
        return new NodeCollection($this->filter, $stmts);
    }

    public function createFromAbsolutePath(AbsolutePath $path): NodeCollection
    {
        return self::createFromRawFile(file_get_contents($path->value()) ?: '');
    }
}
