The default layout template for the Rice Paper carousel widget uses a simple php template as for any other template partial in WordPress. The template may be overridden simply by creating a new template named `widget-v8ch-carousel.php` alongside the `style.css` file in the (child) theme. Check the comments on the template for notes on the included query and template variables used to build the widget HTML output.

    <?php echo $before_widget . PHP_EOL; ?>

    <?php
    /**
     * 
     * The first block of PHP here is the query that pulls the carousel content. In most cases, it will work correctly without modification.
     * But, as it's a standard WordPress query, it can be adjusted for special requirements.
     *
     */
    ?>

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

    <?php
    /**
     * 
     * The layout template. Several of the variables are required for the plugin to build the widget HTML correctly:
     *
     *   - $carousel_id: Required for Slick to identify the HTML block and create the carousel.
     *   - $data_slick: Required configuration options for Slick.
     *   - $count: Required for the Slick option showDots.
     *
     */
    ?>

      <?php if ( $the_query->have_posts() ) : ?>
      <div id="<?php echo $carousel_id; ?>" class="v8ch-carousel" data-slick='<?php echo $data_slick; ?>' itemscope itemtype="http://schema.org/ImageGallery">
        <?php $count = 0;  while ( $the_query->have_posts() ) : $count++; $the_query->the_post(); ?>

          <div id="slide-<?php echo $count; ?>" class="carousel-slide">

            <figure class="full-width" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
              <div class="img-wrap">
                <?php the_post_thumbnail( 'aspect@4x' ); ?>
              </div>
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