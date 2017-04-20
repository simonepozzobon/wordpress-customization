<?php
/**
 * Allow SVG Upload
 */

 function my_myme_types($mime_types){
     $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
     return $mime_types;
 }
 add_filter('upload_mimes', 'my_myme_types', 1, 1);


/**
 * Method of listing upcoming events, complete with functional pagination
 * if WP-PageNavi is installed.
 *
 * Implemented as a shortcode.
 *
 * @see https://wordpress.org/plugins/wp-pagenavi/
 */
function do_easy_event_list()
{
    // Safety first! Bail in the event TEC is inactive/not loaded yet
    if (! class_exists('Tribe__Events__Main')) {
        return;
    }

    // Has the user paged forward, ie are they on /page-slug/page/2/?
    $paged = get_query_var('paged')
        ? get_query_var('paged')
        : 1;

    // Build our query, adopt the default number of events to show per page
    // WP_Query arguments
    $args = array(
        'post_type'              => Tribe__Events__Main::POSTTYPE,
        'post_status'            => array( 'publish' ),
        'paged'                  => $paged

    );

    // The Query
    $upcoming = new WP_Query($args);

    // If we got some results, let's list 'em
    while ($upcoming->have_posts()) {
        $upcoming->the_post();
        $post_id = get_the_ID();
        $title = get_the_title();
        $date  = tribe_get_start_date();

    		echo "<div id=\"$id\" class=\"type-tribe_events tribe-clearfix ".$categories." tribe-events-first tribe-events-last>";
        echo "<h3 class=\"event-calendar-title\"> $date - $title </h3>";
        echo "<div class=\"tribe-events-list-event-description tribe-events-content\">";
        echo the_excerpt();
        echo "<a href=\"".get_permalink($post_id)."\" rel=\"bookmark\">Read More...</a>";
        echo "</div></div>";
    }

    // Is Pagenavi activated? Let's use it for pagination if so
    if (function_exists('wp_pagenavi')) {
        wp_pagenavi(array( 'query' => $upcoming ));
    }

    // Clean up
    wp_reset_query();
}
// Create a new shortcode to list upcoming events, optionally
// with pagination
add_shortcode('easy-event-list', 'do_easy_event_list');

add_filter('tg_register_item_skin', function($skins) {

    // just push your skin slugs (file name) inside the registered skin array
    $skins = array_merge($skins,
        array(
            'personal' => array(
                'filter'   => 'Personal', // filter name used in slider skin preview
                'name'     => 'Personal', // Skin name used in skin preview label
                'col'      => 1, // col number in preview skin mode
                'row'      => 1  // row number in preview skin mode
            )
        )
    );

    // return all skins + the new one we added (my-skin1)
    return $skins;

});
