#!/usr/bin/env php
<?php

declare(strict_types=1);

use RequireOnceGenerator\Application\Command\CreateClassListCacheCommand;
use RequireOnceGenerator\Application\Command\GenerateDependencyListCommand;
use RequireOnceGenerator\Application\Command\InsertRoadFunctionCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application('Require once generator', '0.1.0');
$app->add(new CreateClassListCacheCommand());
$app->add(new GenerateDependencyListCommand());
$app->add(new InsertRoadFunctionCommand());
$app->run();
