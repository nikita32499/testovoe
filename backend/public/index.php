<?php

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
 
$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/../src/models'],
    true,
    null,
    null,
    false
);

$conn = [
    'driver' => 'pdo_mysql',
    'host' => 'db',
    'port' => '3306',
    'user' => 'user',
    'password' => 'secret123',
    'dbname' => 'my_database'
];

$entityManager = EntityManager::create($conn, $config);

$tool = new SchemaTool($entityManager);
$classes = array(
    $entityManager->getClassMetadata(\App\Models\Comment::class)
);

 
try {
    $tool->createSchema($classes);
} catch (\Exception $e) {
     
}
 
$app = AppFactory::create();

require __DIR__ . '/../src/routes.php';

$app->run();