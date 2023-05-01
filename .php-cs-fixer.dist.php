<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer:risky' => true,
        '@Symfony:risky' => true,
        '@PHP80Migration:risky' => true,
        '@PHP80Migration' => true,
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@PHP82Migration' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);
