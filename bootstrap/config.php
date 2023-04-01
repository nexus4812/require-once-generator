<?php

declare(strict_types=1);

namespace My\PhpDiSandbox\PHPDI\AutoWire\Boostrap;

use PhpParser\Parser;
use PhpParser\ParserFactory;
use RequireOnceGenerator\Application\Config\GeneratorConfig;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Application\Config\ProjectPath;
use function DI\autowire;

return [
    Parser::class => fn(): Parser => (new ParserFactory)->create(ParserFactory::PREFER_PHP7),
    ProjectPath::class => fn(): ProjectPath => (new ProjectPath(getcwd() ?: '')),
    GeneratorConfigInterface::class => autowire(GeneratorConfig::class)
];
