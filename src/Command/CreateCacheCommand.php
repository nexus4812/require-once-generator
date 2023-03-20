<?php declare(strict_types=1);


namespace RequireOnceGenerator\Command;

use RequireOnceGenerator\Analyzer\GenerateClassList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCacheCommand extends Command
{
    protected static $defaultName = 'create-class-map';
    /**
     * @var GenerateClassList
     */
    private GenerateClassList $generateClassPath;

    /**
     * @param GenerateClassList $generateClassPath
     * @return CreateCacheCommand
     */
    public function setGenerateClassPath(GenerateClassList $generateClassPath): self
    {
        $this->generateClassPath = $generateClassPath;
        return $this;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->generateClassPath->create();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate class map')
            ->addOption('path', '-p', InputOption::VALUE_REQUIRED, 'class source directory');
    }
}
