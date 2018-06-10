<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

/* $app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
}); */

/* $app->hook('slim.before', function () use ($app) {	
	$base = "http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);	
	$app->view()->appendData(array(
		'site_url' => $base,
		// 'template_url' => $base . '/templates/ghpages',
	));
}); */