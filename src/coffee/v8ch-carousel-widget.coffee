# Find and initialize all v8ch-carousel-widget objects on the page
jQuery(document).ready(
  ->
    jQuery('.v8ch-carousel').each(
      ->
        id = jQuery(this).attr('id')
        jQuery('#' + id).slick()
        return
    )
    return
)