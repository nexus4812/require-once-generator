<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Command;

use RequireOnceGenerator\Application\Analyzer\GenerateClassList;
use RequireOnceGenerator\Application\Container\ContainerManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClassListCacheCommand extends Command
{
    protected static $defaultName = 'create-class-map';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var GenerateClassList $class */
        $class = ContainerManager::resolve(GenerateClassList::class);
        $class->create();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate class map')
            ->addOption('path', '-p', InputOption::VALUE_REQUIRED, 'class source directory');
    }
}
