<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('debug' => true);
$app['twig']->addExtension(new Twig_Extension_Debug());
