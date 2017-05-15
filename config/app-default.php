<?php

use Silex\Application;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TranslationServiceProvider;

$app = new Application();
// enable the debug mode
$app['debug'] = true;

$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->register(new TranslationServiceProvider(), array(
    'locale' => 'fr',
    'locale_fallbacks' => array('en')
));

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});

$app->register(new SessionServiceProvider(), array(
    'session.storage.options' => array('cookie_lifetime' => 10800)
));

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'xxxx',
        'dbname' => 'xxxx',
        'user' => 'xxxx',
        'password' => 'xxxx',
    ),
));

$app->register(new DoctrineOrmServiceProvider, array(
    'orm.class_path' => __DIR__ . '/../vendor/doctrine/orm/lib',
    'orm.proxies_dir' => __DIR__ . '/../var/cache/doctrine/Proxy',
    'orm.proxies_namespace' => 'DoctrineProxy',
    'orm.auto_generate_proxies' => true,
    'orm.class_metadata_factory_name' => 'Doctrine\ORM\Mapping\ClassMetadataFactory',
    'orm.default_repository_class' => 'Doctrine\ORM\EntityRepository',
    'orm.add_mapping_driver' => 'Doctrine\Common\Persistence\Mapping\Driver\MappingDriver',
    'orm.em.options' => array(
        'mappings' => array(
            // Using actual filesystem paths
            array(
                'type' => 'annotation',
                'namespace' => 'Entity',
                'path' => __DIR__ . '/../src/Entity',
                "use_simple_annotation_reader" => false,
            )
        ),
    ),
));
require __DIR__ . '/routes.php';

return $app;