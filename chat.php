<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Controller\Chat;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\DriverManager;

require dirname(__DIR__) . '/vendor/autoload.php';

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true, null, null, false);

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'Proyecto_AdriaLeonAris_DAW2',
    'host'     => '127.0.0.1',
    'port'     => '3306'
);

$conn = DriverManager::getConnection($dbParams, $config);
$entityManager = EntityManager::create($conn, $config);
$jwtKey = 'your_jwt_key_here';

$chat = new Chat($jwtKey, $entityManager);

$server = IoServer::factory(
    new HttpServer(
        new WsServer($chat)
    ),
    8080
);

$server->run();
