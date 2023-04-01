#!/usr/bin/env php
<?php

use DI\Container;
use RequireOnceGenerator\Analyzer\GenerateClassList;
use RequireOnceGenerator\Analyzer\GenerateRequireOnce;
use RequireOnceGenerator\Command\CreateClassListCacheCommand;
use RequireOnceGenerator\Command\GenerateRequireOnceCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

/** @var Container $container */
$container = require_once __DIR__ .'/bootstrap/container.php';

$app = new Application('Require once generator', '0.1.0');
$app->add((new CreateClassListCacheCommand())->setGenerateClassList($container->make(GenerateClassList::class)));
$app->add((new GenerateRequireOnceCommand())->setGenerateRequireOnce($container->make(GenerateRequireOnce::class)));
$app->run();
