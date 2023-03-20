#!/usr/bin/env php
<?php

use DI\Container;
use RequireOnceGenerator\Analyzer\GenerateClassPath;
use RequireOnceGenerator\Command\CreateCacheCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

/** @var Container $container */
$container = require_once __DIR__ .'/bootstrap/container.php';

$app = new Application('Require once generator', '0.1.0');
$app->add((new CreateCacheCommand())->setGenerateClassPath($container->make(GenerateClassPath::class)));
$app->run();
