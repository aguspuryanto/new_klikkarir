<?php
// DIC configuration

$container = $app->getContainer();

// Service factory for the ORM
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

/* $container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
}; */

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
	$baseUrl = "http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	$template = explode("..", $settings['template_path']);
    return new Slim\Views\PhpRenderer($settings['template_path'], [
		'baseUrl' => rtrim($baseUrl, "/"),
        'templateUrl' => $baseUrl . $template[1] . "mybreeze/"
	]);
};

// Register component on container
/* $container['view'] = function ($container) {
	$baseUrl = "http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
    return new \Slim\Views\PhpRenderer('templates/classimax-master/', [
        'baseUrl' => rtrim($baseUrl, "/"),
        'templateUrl' => $baseUrl . "/templates/classimax-master"
    ]);
}; */

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// error handle
$container['errorHandler'] = function ($c) {
  return function ($request, $response, $exception) use ($c) {
    $data = [
      'code' => $exception->getCode(),
      'message' => $exception->getMessage(),
      'file' => $exception->getFile(),
      'line' => $exception->getLine(),
      'trace' => explode("\n", $exception->getTraceAsString()),
    ];

    return $c->get('response')->withStatus(500)
             ->withHeader('Content-Type', 'application/json')
             ->write(json_encode($data));
  };
};