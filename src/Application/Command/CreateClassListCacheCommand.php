<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Command;

use DI\DependencyException;
use DI\NotFoundException;
use RequireOnceGenerator\Application\Analyzer\GenerateClassList;
use RequireOnceGenerator\Application\Container\ContainerManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClassListCacheCommand extends Command
{
    protected static $defaultName = 'create-class-list';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     *
     * @throws DependencyException
     * @throws NotFoundException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ContainerManager::resolve(GenerateClassList::class)->create();
        $output->writeln(self::$defaultName. ' is completed');
        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setDescription('Create a correspondence table between php classes and the absolute paths where they exist');
    }
}
