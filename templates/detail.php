<!DOCTYPE html>
<html ng-app="myApp" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Jumbotron Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=$baseUrl;?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=$baseUrl;?>/jumbotron.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <script src="<?=$baseUrl;?>/dist/js/jquery.min.js"></script>
	<script src="<?=$baseUrl;?>/dist/js/angular.min.js"></script>
</head>
<body ng-controller="myCtrl">
	<header class="header">		
		<!-- Navigation Bar-->
		<nav id="topnav" class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">klik<span class="text-danger">karir</span>.com</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.navbar-collapse -->
		  </div>
		</nav>
	</header>
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
		<div class="tophead text-center">
			<img src="logo2.png"> 
		</div>
        <form class="form-inline text-center">			
			<input type="text" class="form-control input-lg" placeholder="Masukkan jabatan atau perusahaan">
			<input type="text" class="form-control input-lg" placeholder="Indonesia">
			<button type="submit" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-search"></i> </button>
		</form>
      </div>
    </div>

    <section id="byCity">
		<div class="container clearfix">
		  <!-- Example row of columns -->
		  <h4>Pencarian pekerjaan berdasarkan kota</h4>
		  <div class="row">
			
			<div class="col-md-3">
			  
			</div>
			
			<div class="col-md-9">
				<?php //var_dump($jobsCatategory); 
				$content = json_decode($content, true);
				foreach($content as $post): ?>
				<div class="media card">
				  <div class="media-body card-content">
					<a href="<?=$baseUrl;?>/jobs/<?=\Post::slugify($post['posisi'].'-'.$post['vacid']); ?>">
						<h4 class="media-heading"><?=$post['posisi']; ?></h4>
					</a>
					<p>
						<span>Deskripsi:</span>
						<?=nl2br($post['desjob']); ?>
					</p>
					<p><span>Requirement:</span> <?=nl2br($post['req']); ?></p>
				  </div>
				</div>
				<?php endforeach; ?>
			</div>
			
		  </div>
		</div> <!-- /container -->
	</section>
	
	<hr>

    <footer>
		<div class="container">
		<p>&copy; 2016 Company, Inc.</p>
		</div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=$baseUrl;?>/dist/js/bootstrap.min.js"></script>
	<script>var baseUrl = "<?=$baseUrl;?>";</script>
    <script src="<?=$baseUrl;?>/dist/js/app.js"></script>
  </body>
</html>
