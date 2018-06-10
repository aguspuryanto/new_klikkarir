<?php

use Slim\Http\Request;
use Slim\Http\Response;

// use App\Models\Category;
// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    // return $this->renderer->render($response, 'index.php', $args);
    return $this->renderer->render($response, 'main.php');
});

/*
 * Kota URL:
 * http://klikkarir.com/kota/surabaya
 */
 
$app->get('/lokasi/[{name}]', function ($request, $response, $args) {
	
	// echo "select * from vacancylowo where lokasi like '".$args['name']."'";
	$page = $request->getParam('page');
	$page = isset($page) ? $page : 1;
	$offset = ($page - 1) * 10;
	
	$bycity = \Post::get_city((string)$args['name']);
	// return $bycity->toJson();
	
    return $this->renderer->render($response, 'jobs.php', array(
		'jobsCatategory' => $bycity->toJson()
	));
	

});

/*
 * Kategori URL:
 * http://www.klikkarir.com/kategori/
 * http://www.klikkarir.com/kategori/administrasi-sekretaris/
 */

$app->get('/lowongan-kerja/[{name}]', function ($request, $response, $args) {
	
	// echo "select * from vacancylowo where lokasi like '".$args['name']."'";
	$page = $request->getParam('page');
	$page = isset($page) ? $page : 1;
	$offset = ($page - 1) * 10;
	
	$bycategory = \Post::get_category((string)$args['name']);
	// return $bycity->toJson();
	
    return $this->renderer->render($response, 'jobs.php', array(
		'jobsCatategory' => $bycategory->toJson()
	));
});

/*
 * Detail URL :
 * http://klikkarir.com/detail/117233/loker-sales-online.html
 * http://klikkarir.com/job/117381/chef-cook-helper
 */
$app->get('/jobs/[{name}]', function ($request, $response, $args) {
	
	// echo $args['name'];
	$postid = preg_replace('/[^0-9]/', '', $args['name']);
	
	$detailJobs = \Post::get_detailJobs((int)$postid);
	// return $bycity->toJson();
	
    return $this->renderer->render($response, 'detail.php', array(
		'content' => $detailJobs->toJson()
	));
});

/*
 * Company Profile URL:
 * http://klikkarir.com/cmp/E000011062/pt-rotary-bintaro-2
 *
 * http://klikkarir.com/standar-gaji
 * http://klikkarir.com/artikel/
 * http://klikkarir.com/blacklist
 * http://klikkarir.com/cari
 * http://klikkarir.com/cari?hal=2
 */
 
 

$app->group('/api', function () {
	$this->get('/frontByCity', function ($request, $response, $args) {
        // Route for /billing
		$page = $request->getParam('page');
		$page = isset($page) ? $page : 1;
		$offset = ($page - 1) * 10;
		
		// $emp = \Post::orderBy('vacid', 'desc')->skip($offset)->take(10)->get();
		$emp = \Post::get_citytot();
		return $emp->toJson();
    });
	
	$this->get('/frontByCategory', function ($request, $response, $args) {
        // Route for /billing
		$page = $request->getParam('page');
		$page = isset($page) ? $page : 1;
		$offset = ($page - 1) * 10;
		
		$emp = \Post::get_katot();
		return $emp->toJson();
    });
	
	$this->get("/postdemo", function($request, $response, $args){
		$page = $request->getParam('page');
		$page = isset($page) ? $page : 1;
		$offset = ($page - 1) * 100;
		
		$demo = \Post::take(100)->skip($offset)->get();
		// return $demo->toJson();
		
		$demo = \Category::get_CategoryID("Konstruksi");
		return $demo->toJson();
		
		/* foreach($demo as $dm){
			if($dm['kategori']) {
				$catid = new models\Category();
				$catid = $catid::get_CategoryID($dm['kategori']);
				echo "-".$dm['kategori']." - ".$catid[0]."<br>";
			}
		} */
	});
	
});