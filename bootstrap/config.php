<?php

declare(strict_types=1);

namespace My\PhpDiSandbox\PHPDI\AutoWire\Boostrap;

use PhpParser\Parser;
use PhpParser\ParserFactory;
use RequireOnceGenerator\Config\GeneratorConfig;
use RequireOnceGenerator\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Config\ProjectPath;
use function DI\autowire;

return [
    Parser::class => fn(): Parser => (new ParserFactory)->create(ParserFactory::PREFER_PHP7),
    ProjectPath::class => fn(): ProjectPath => (new ProjectPath(getcwd() ?: '')),
    GeneratorConfigInterface::class => autowire(GeneratorConfig::class)
];
