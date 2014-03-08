<?php
/**
 * Filters are functions that WordPress passes data through, at certain points 
 * in execution, just before taking some action with the data (such as adding 
 * it to the database or sending it to the browser screen). Filters sit between 
 * the database and the browser (when WordPress is generating pages), and 
 * between the browser and the database (when WordPress is adding new posts and 
 * comments to the database); most input and output in WordPress passes through 
 * at least one filter. WordPress does some filtering by default, and your 
 * plugin can add its own filtering.
 * 
 * @link http://codex.wordpress.org/Plugin_API#Filters
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference
 * @link http://adambrown.info/p/wp_hooks
 */

/**
 * Set Excerpt length in words
 * @param int $length
 * @return int set post excerpt length
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function bigblank_excerpt_length($length) {
    return 23; // Just for Jordan
}

add_filter('excerpt_length', 'bigblank_excerpt_length');

/**
 *  add ... and return excerpt more
 */
function bigblank_excerpt_more($more) {
    return ' &hellip;';
}

add_filter('excerpt_more', 'bigblank_excerpt_more');

if (!function_exists('bigblank_the_attached_image')) :

    /**
     * Print the attached image with a link to the next attached image.
     *
     *
     * @return void
     */
    function bigblank_the_attached_image() {
        $post = get_post();
        /**
         * Filter the default Big Blank attachment size.
         *
         *
         * @param array $dimensions {
         *     An array of height and width dimensions.
         *
         *     @type int $height Height of the image in pixels. Default 810.
         *     @type int $width  Width of the image in pixels. Default 810.
         * }
         */
        $attachment_size = apply_filters('bigblank_attachment_size', array(960, 640));
        $next_attachment_url = wp_get_attachment_url();
        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts(array(
            'post_parent' => $post->post_parent,
            'fields' => 'ids',
            'numberposts' => -1,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
        ));
        // If there is more than 1 attachment in a gallery...
        if (count($attachment_ids) > 1) {
            foreach ($attachment_ids as $attachment_id) {
                if ($attachment_id == $post->ID) {
                    $next_id = current($attachment_ids);
                    break;
                }
            }
            // get the URL of the next image attachment...
            if ($next_id) {
                $next_attachment_url = get_attachment_link($next_id);
            }
            // or get the URL of the first image attachment.
            else {
                $next_attachment_url = get_attachment_link(array_shift($attachment_ids));
            }
        }
        printf('<a href="%1$s" rel="attachment">%2$s</a>', esc_url($next_attachment_url), wp_get_attachment_image($post->ID, $attachment_size)
        );
    }

endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to hAtom Schema purpose
 * No need for additional div wrapper
 * 
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function bigblank_body_classes($classes) {
    $classes[] = 'hfeed site';
    return $classes;
}
add_filter('body_class', 'bigblank_body_classes');

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function bigblank_wp_title($title, $sep) {
    global $paged, $page;
    if (is_feed()) {
        return $title;
    }
    // Add the site name.
    $title .= get_bloginfo('name');
    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }
    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'bigblank'), max($paged, $page));
    }
    return $title;
}

add_filter('wp_title', 'bigblank_wp_title', 10, 2);

// This function adds nice anchor with id attribute to our h2 tags for reference
// Ref: http://www.w3.org/TR/html4/struct/links.html#h-12.2.3
function anchor_content_h2($content) {

    // Pattern that we want to match
    $pattern = '/<h2>(.*?)<\/h2>/';

    // now run the pattern and callback function on content
    $content = preg_replace_callback($pattern,
            // function to replace the title with an id
            function ($matches) {
        $title = $matches[1];
        $slug = sanitize_title_with_dashes($title);
        return '<h2 id="' . $slug . '">' . $title . '</h2>';
    }
            , $content);
    return $content;
}

add_filter('the_content', 'anchor_content_h2');

/**
 * Filter <p> tags wrapping images and iframes
 * comment out if you wish to keep them in <p> tags.
 * \2 a tag open
 * \4 image tag
 * \6 iframe tag
 * \7 a tag close
 * \1-8 is the group of paranthesis returned
 * "generally, the results of the captured groups are in the order in which they
 * are defined (the open parenthesis)"
 * Exclude alignleft and alignright images, and also images middle of  the 
 * paragraphs. Also remove wrapping paragraph of images inside spans.
 * @link http://regexone.com/lesson/
 * @link http://rubular.com/r/ZybUS108Vq
 */
function remove_ptags_around_images_and_iframes($content) {
    return preg_replace('/<p.?>\s?(<span .*>)?\s*(<a .*>)?\s*((<img[^>]+class="(?!(?:.+\s)?alignleft|alignright(?:\s.+)?")([^"]+)".*\/>)|(<iframe .*>*.<\/iframe>))\s*(<\/a>)?\s*(<\/span>)?\s*<\/p>/iU', '\2\4\6\7', $content);
}

add_filter('the_content', 'remove_ptags_around_images_and_iframes');
