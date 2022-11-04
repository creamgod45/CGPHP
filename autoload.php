<?php
$ClassLoader = new Nette\Loaders\RobotLoader;
$ClassLoader->setAutoRefresh(true);
$ClassLoader->excludeDirectory(PATH.'/lib/example');
$ClassLoader->addDirectory(PATH . '/lib');
$ClassLoader->setTempDirectory(PATH . '/temp');
$ClassLoader->register();

