<?php

declare(strict_types=1);

namespace My\PhpDiSandbox\PHPDI\AutoWire\Boostrap;

use PhpParser\Parser;
use PhpParser\ParserFactory;

return [
    Parser::class => function() {
        return (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }
];
