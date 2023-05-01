<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Parser;

use PhpParser\Parser;
use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;
use RuntimeException;

class NodeCollectionFactory
{
    public function __construct(
        private NodeFilter $filter,
        private Parser $parser
    ) {
    }

    public function createFromRawFile(string $rawCode): NodeCollection
    {
        $stmts = $this->parser->parse($rawCode);
        if (null === $stmts) {
            throw new RuntimeException('parse return is null');
        }
        return new NodeCollection($this->filter, $stmts);
    }

    public function createFromAbsolutePath(AbsolutePath $path): NodeCollection
    {
        $file = file_get_contents($path->value());
        if ($file === false) {
            throw new RuntimeException("file_get_content return is false");
        }
        return self::createFromRawFile($file);
    }
}
