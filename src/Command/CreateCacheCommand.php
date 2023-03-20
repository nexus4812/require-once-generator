<?php declare(strict_types=1);


namespace RequireOnceGenerator\Command;

use RequireOnceGenerator\Analyzer\GenerateClassPath;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCacheCommand extends Command
{
    protected static $defaultName = 'create-class-map';
    /**
     * @var GenerateClassPath
     */
    private GenerateClassPath $generateClassPath;

    /**
     * @param GenerateClassPath $generateClassPath
     * @return CreateCacheCommand
     */
    public function setGenerateClassPath(GenerateClassPath $generateClassPath): self
    {
        $this->generateClassPath = $generateClassPath;
        return $this;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getOption('path');

        if (!\is_string($path)) {
            throw new InvalidArgumentException('The path option required');
        }

        $this->generateClassPath->create($path);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate class map')
            ->addOption('path', '-p', InputOption::VALUE_REQUIRED, 'class source directory');
    }
}
