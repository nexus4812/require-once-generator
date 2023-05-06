<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Command;

use DI\DependencyException;
use DI\NotFoundException;
use ReflectionException;
use RequireOnceGenerator\Application\Analyzer\GenerateClassList;
use RequireOnceGenerator\Application\Analyzer\GenerateDependencyList;
use RequireOnceGenerator\Application\Container\ContainerManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertRoadFunctionCommand extends Command
{
    protected static $defaultName = 'insert-road-function-command';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws DependencyException
     * @throws NotFoundException|ReflectionException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ContainerManager::resolve(GenerateClassList::class)->create();
        ContainerManager::resolve(GenerateDependencyList::class)->create();
        // TODO create
        $output->writeln(self::$defaultName. ' is completed');
        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setDescription('Insert functions to perform loads, such as require_once, for .php files');
    }
}