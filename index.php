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
		<link rel="stylesheet" media="screen" type="text/css" href="inc/css/animate.css" />
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
			<?php $movies = $rotten->get_movies_in_box_office(); ?>

			<?php foreach( $movies as $movie ) {
				$movie = (object)$movie;
				$classes = array( 'bg1', 'bg2', 'bg3', 'bg4', 'bg5', 'bg6', 'bg7' ); // bg color classes for titles
				$thumb = Rotten::strip_flixster( $movie->posters['profile'] );
				?>

				<div
					id="m_<?php echo $movie->id; ?>"
					class="movie"
					style="background-image: url(<?php echo $thumb ?>);"

					<?php
						/**
						 * we already consumed an api call to ge this data. There's no reason to query it again
						 * when we show the detail view when we can just share it with the window from here via data
						 * attributes
						 */
					?>
					data-id="<?php echo $movie->id; ?>"
					data-mpaa-rating="<?php echo $movie->mpaa_rating; ?>"
					data-year="<?php echo $movie->year; ?>"
					data-runtime="<?php echo $movie->runtime; ?>"
					data-critics-concensus="<?php echo $movie->critics_concensus ? $movie->critics_concensus : ''; ?>"
					data-release-date="<?php echo $movie->release_dates['theater']; ?>"
					data-synopsis="<?php echo $movie->synopsis; ?>"
					data-poster-image="<?php echo $thumb; ?>"
				>
					<h2 class="<?php echo $classes[ $x % count( $classes ) ]; ?>">
						<?php printf( '%s (%d)', $movie->title, $movie->year ); ?>
					</h2>
					<div class="overlay animated"></div>

					<p class="more-info animated">
						<a href="#" class="animated">More Info</a>
					</p>
				</div>
			<?php $x++; } ?>
		</div>

		<footer></footer>

	</body>
</html>