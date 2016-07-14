The Rice Paper theme and custom plugins are only available when bundled with deliverables presented by V8CH as part of a WordPress website development project. Once a website project has launched, copies of all V8CH themes and plugins are available by logging in to the V8CH website. Though they do not appear in the WordPress plugin repository, installation uses standard tools for [manual installation](http://ewp.guide/go/adding-new-plugin).

### Updates

Updates for all themes and plugins appear automatically using the [built-in WordPress updates system](http://ewp.guide/go/keeping-your-site-updated). All updates are tested before release, but it is good practice to perform a complete backup of all your data before updating any part of the WordPress system: core files, themes or plugins.

### Creating the Widget

WordPress widgets create selections of content that appear in widget areas defined by a theme. Rice Paper uses one widget area, a sidebar that appears on blog posts pages. For mobile display, the sidebar follows the main content section. On larger displays, the sidebar appears on the left-hand side of the window next to the main content section. Add the Rice Paper card widget to the sidebar using [the build-in WordPress admin tools](http://ewp.guide/go/widgets).

While sidebars may contain them, carousel components commonly have a featured position in the main content areas of webpages, at the top of the page ("above the fold") or in a prominent position after introductory content. Child themes of Rice Paper use the carousel widget this way by creating new widget areas or by dynamically placing it using a WordPress [built-in template tag](https://developer.wordpress.org/reference/functions/the_widget/).

In either use case, once an area for a carousel component is defined on a webpage, the carousel is built using a straightforward process. First, define a carousel tag assigned to a collection of slides. Second, enter each slide as a distinct carousel slide post type. Third, configure the widget. The steps may be performed in any order, though the sequence outlined above is the most direct.

### Table of Contents

- [Carousel Slides](/plugins/rice-paper-carousel-widget/using/carousel-slides)
- [Carousel Tags](/plugins/rice-paper-carousel-widget/using/carousel-tags)
- [Widget Configuration](/plugins/rice-paper-carousel-widget/using/widget-configuration)
- [Layout Templates](/plugins/rice-paper-carousel-widget/using/layout-templates)