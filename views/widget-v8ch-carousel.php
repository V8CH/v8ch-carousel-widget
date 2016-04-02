<?php echo $before_widget . PHP_EOL; ?>
<?php if ( $instance['tax_slug'] != '' ) :
	$the_query = new WP_Query( array(
		'post_type'      => 'slide',
		'tax_query'      => array(
			array(
				'taxonomy' => 'carousels',
				'field'    => 'slug',
				'terms'    => $instance['tax_slug'],
			),
		),
		'posts_per_page' => 3,
	) );
	$is_first = true; // Flag for first post, if any found.
	$buttons = ''; // Holds HTML for Orbit buttons
	?>

	<?php if ( $the_query->have_posts() ) : ?>
	<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
		<ul class="orbit-container">
			<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
			<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>

			<?php $count = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<!-- Slide #<?php echo $count; ?> -->
				<li class="<?php if ( $is_first ) {
					echo 'is-active';
				} ?> orbit-slide">
					<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article">
						<header class="article-header">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark"
							       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						</header> <!-- end article header -->

						<section class="entry-content" itemprop="articleBody">
							<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
							<?php the_content( '<span class="badge"><span class="fa fa-chevron-right"></span><span class="fa fa-chevron-right"></span></span>' . __( 'Read more', 'rice-paper' ) ); ?>
						</section> <!-- end article section -->

						<footer class="article-footer">
							<?php // Retained for now for semantics ?>
						</footer> <!-- end article footer -->
					</article> <!-- end article -->
				</li>
				<?php
				// Create markup for Orbit button here
				$alt = get_post_meta( get_post_thumbnail_id($post->ID) , '_wp_attachment_image_alt', true);
				if ( $is_first ) {
					$buttons .= "\t" . '<button class="is-active" data-slide="' . $count . '"><span class="show-for-sr">' . $alt . '</span></button>' . PHP_EOL;
					$is_first = false;
				} else {
					$buttons .= "\t" . '<button data-slide="' . $count . '"><span class="show-for-sr">' . $alt . '</span></button>' . PHP_EOL;
				}
				?>
			<?php $count++; endwhile; ?>

			<?php wp_reset_postdata(); ?>
		</ul>
		<nav class="orbit-bullets">
			<?php echo $buttons; ?>
		</nav>
	</div>
<?php endif; // have_posts()
	?>
<?php endif; // $tax_slug != '' ?>
<?php echo $after_widget; ?>