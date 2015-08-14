<?php
	require_once( 'inc/lib/rotten.class.php' );
	$rotten = new Rotten();

	$movies = $rotten->get_movies_in_box_office();

	$x = 0; // iterator to switch between color classes with.
	$use_full_image = true; // use full size poster images - loads really slow.
	$classes = array( 'bg1', 'bg2', 'bg3', 'bg4', 'bg5', 'bg6', 'bg7' ); // bg color classes for titles
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title>Rotten.</title>

		<link rel="stylesheet" media="screen" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,700,300|Montserrat:400,700">
		<link rel="stylesheet" media="screen" type="text/css" href="inc/css/animate.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="inc/css/style.css" />

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="inc/js/modernizr.custom.js"></script>
		<script src="inc/js/helper.js"></script>
		<script src="inc/js/grid3d.js"></script>
		<script src="inc/js/script.js"></script>
	</head>
	<body>

		<header>
			<h1>Rotten.</h1>
		</header>

		<div class="container horizontal" id="grid3d">

			<div class="grid-wrap">
				<div class="grid">
					<?php foreach( $movies as $movie ) {
						$movie = (object)$movie;

						if( $use_full_image ) {
							$thumb = Rotten::strip_flixster($movie->posters['profile']);
						} else {
							$thumb = $movie->posters['profile'];
						}

						?>
						<div
							id="m_<?php echo $movie->id; ?>"
							class="movie"
							data-hash="<?php echo urlencode( $movie->title ); ?>"
							style="background-image: url(<?php echo $thumb ?>);"
						>
							<h2 class="<?php echo $classes[ $x % count( $classes ) ]; ?>">
								<?php printf( '%s (%d)', $movie->title, $movie->year ); ?>
							</h2>
							<div class="overlay animated"></div>

							<p class="more-info animated">
								<a href="#" class="animated" onclick="return false;">More Info</a>
							</p>
						</div>
					<?php $x++; } ?>
				</div>
			</div>

			<div class="content">

				<?php
					foreach( $movies as $movie ) {
						$movie = (object)$movie;
						?>
						<div class="movie-details">
							<div class="detail-image">
								<?php
									if( $use_full_image ) {
										$thumb = Rotten::strip_flixster($movie->posters['profile']);
									} else {
										$thumb = $movie->posters['profile'];
									}
								?>
								<img
									src="<?php echo $thumb; ?>"
									alt="<?php printf( '%s Poster Image', $movie->title ); ?>"
								>
							</div>
							<div class="detail-info">
								<h2><?php echo $movie->title; ?></h2>
								<ul class="meta">
									<li>
										<strong>MPAA Rating: </strong> <?php echo $movie->mpaa_rating; ?>
									</li>
									<li>
										<strong>Year: </strong> <?php echo $movie->year; ?>
									</li>
									<li>
										<strong>Runtime: </strong> <?php echo Rotten::format_runtime( $movie->runtime ); ?>
									</li>
									<li>
										<strong>Release Date: </strong> <?php echo $movie->release_dates['theater']; ?>
									</li>
								</ul>

								<?php if( isset( $movie->critics_consensus ) && ! empty( $movie->critics_consensus ) ) : ?>
									<h4>Critics Consensus</h4>
									<p><?php echo $movie->critics_consensus; ?></p>
								<?php endif; ?>

								<h4>Ratings</h4>
								<ul>
									<li>
										<strong>Critics: </strong>
										<?php
											printf(
												'%s (%d)',
												$movie->ratings['critics_rating'],
												$movie->ratings['critics_score']
											);
										?>
									</li>
									<li>
										<strong>Audience: </strong>
										<?php
											printf(
												'%s (%d)',
												$movie->ratings['audience_rating'],
												$movie->ratings['audience_score']
											);
										?>
									</li>

								</ul>

								<h4>Synopsis</h4>
								<p><?php echo join( '</p><p>', explode( "\n", $movie->synopsis ) ); ?></p>

								<h4>Cast</h4>
								<ul>
									<?php foreach( $movie->abridged_cast as $actor ) : ?>
										<li>
											<strong><?php echo $actor['name']; ?></strong>
											<?php if( isset( $actor['characters'] ) && is_array( $actor['characters'] ) ) : ?>
												as <?php echo join( ', ', $actor['characters'] ); ?>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>

						<?php
					}
				?>

				<span class="loading"></span>
				<span class="icon close-content"></span>

			</div>
		</div>

		<footer></footer>

		<script>
			new grid3D( document.getElementById( 'grid3d' ) );
		</script>

	</body>
</html>