<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->path([
        __DIR__ . '/generator.php',
        __DIR__ . '/.php-cs-fixer.dist.php',
    ])
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/bootstrap',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer:risky' => true,
        '@Symfony:risky' => true,
        '@PHP80Migration:risky' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);
