<?php
// PHP8.3
declare(strict_types=1);

$loader = new \Phalcon\Autoload\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->setDirectories(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,

        $config->application->utilsDir,
    ]
)->register();
