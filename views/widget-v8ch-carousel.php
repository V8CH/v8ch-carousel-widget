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
		'posts_per_page' => -1,
	) );
	?>

	<?php if ( $the_query->have_posts() ) : ?>
	<div id="<?php echo $carousel_id; ?>" class="v8ch-carousel" data-slick='<?php echo $data_slick; ?>' itemscope itemtype="http://schema.org/ImageGallery">
		<?php $count = 0;  while ( $the_query->have_posts() ) : $count++; $the_query->the_post(); ?>

			<div id="slide-<?php echo $count; ?>" class="carousel-slide">

				<figure class="full-width" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
					<?php the_post_thumbnail( 'aspect@4x' ); ?>
					
					<figcaption itemprop="caption description">
						<h4 itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<?php the_content(); ?>
					</figcaption>
				</figure>
			</div> <!-- /slide-<?php echo $count; ?> -->
		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>
	</div>
	<?php endif; // have_posts() ?>
<?php endif; // $instance['tax_slug'] != '' ?>
<?php echo $after_widget; ?>