<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Command;

use RequireOnceGenerator\Application\Analyzer\GenerateClassList;
use RequireOnceGenerator\Application\Analyzer\GenerateRequireOnce;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRequireOnceCommand extends Command
{
    protected static $defaultName = 'generate-require-once';

    private GenerateRequireOnce $generateRequireOnce;


    public function setGenerateRequireOnce(GenerateRequireOnce $generateRequireOnce): self
    {
        $this->generateRequireOnce = $generateRequireOnce;
        return $this;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->generateRequireOnce->create();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setDescription('Generate class map');
    }
}