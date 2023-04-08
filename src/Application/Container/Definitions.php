<?php declare(strict_types=1);

namespace RequireOnceGenerator\Application\Container;

use Closure;
use DI\Definition\Helper\DefinitionHelper;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use RequireOnceGenerator\Application\Config\GeneratorConfig;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Application\Config\ProjectPath;
use function DI\autowire;

class Definitions
{
    /**
     * @return array<class-string, Closure|DefinitionHelper>
     */
    public static function getDefinitions(): array
    {
        return [
            Parser::class => fn(): Parser => (new ParserFactory)->create(ParserFactory::PREFER_PHP7),
            ProjectPath::class => fn(): ProjectPath => (ProjectPath::createByCwd()),
            GeneratorConfigInterface::class => autowire(GeneratorConfig::class),
        ];
    }
}
