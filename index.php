<?php
	require_once( 'inc/lib/rotten.class.php' );
	$rotten = new Rotten();

	$x = 0;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title>RottenTomatoes API Example</title>

		<link rel="stylesheet" media="screen" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,700,300|Montserrat:400,700">
		<link rel="stylesheet" media="screen" type="text/css" href="inc/css/style.css" />

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="inc/js/script.js"></script>
	</head>
	<body>

		<header>
			<h1>Rotten.</h1>
		</header>

		<div class="container">
			<?php foreach( $rotten->get_movies_in_box_office() as $movie ) {
				$movie = (object)$movie;
				$classes = array( 'bg1', 'bg2', 'bg3', 'bg4', 'bg5', 'bg6', 'bg7' );
				?>

				<div class="movie <?php echo $classes[ $x % count( $classes ) ]; ?>">
					<div class="poster">
						<img src="<?php echo $movie->posters['profile']; ?>" alt="<?php printf( '%s (%d)', $movie->title, $movie->year ); ?>">
					</div>
					<div class="info">
						<h2><?php echo $movie->title; ?></h2>
						<p><?php echo $movie->synopsis; ?></p>
					</div>
				</div>
			<?php $x++; } ?>
		</div>

		<footer></footer>

	</body>
</html>