<?php
/**
 * Custom template tags for Big Blank
 * Used to create custom html output for our theme
 */
/**
 * Menus are called from header and footer
 *
 * Optional $args contents:
 *
 * menu - The menu that is desired. Accepts (matching in order) id, slug, name. Defaults to blank.
 * menu_class - CSS class to use for the ul element which forms the menu. Defaults to 'menu'.
 * menu_id - The ID that is applied to the ul element which forms the menu. Defaults to the menu slug, incremented.
 * container - Whether to wrap the ul, and what to wrap it with. Defaults to 'div'.
 * container_class - the class that is applied to the container. Defaults to 'menu-{menu slug}-container'.
 * container_id - The ID that is applied to the container. Defaults to blank.
 * fallback_cb - If the menu doesn't exists, a callback function will fire. Defaults to 'wp_page_menu'. Set to false for no fallback.
 * before - Text before the link text.
 * after - Text after the link text.
 * link_before - Text before the link.
 * link_after - Text after the link.
 * echo - Whether to echo the menu or return it. Defaults to echo.
 * depth - how many levels of the hierarchy are to be included. 0 means all. Defaults to 0.
 * walker - allows a custom walker to be specified.
 * theme_location - the location in the theme to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
 * items_wrap - How the list items should be wrapped. Defaults to a ul with an id and class. Uses printf() format with numbered placeholders.
 *
 */
if (!function_exists('bigblank_main_menu')) :

    /**
     * Main navigation menu
     */
    function bigblank_main_menu() {
        wp_nav_menu(array(
            'menu' => 'main_menu',
            'theme_location' => 'main_menu',
            'container' => 'nav',
            'depth' => 2,
            'fallback_cb' => 'bigblank_menu_fallback',
            'container_id' => 'nav'
        ));
    }

endif;

if (!function_exists('bigblank_footer_menu')) :

    /**
     * Footer menu
     */
    function bigblank_footer_menu() {
        wp_nav_menu(array(
            'menu' => 'footer_menu',
            'theme_location' => 'footer_menu',
            'container' => 'nav',
            'container_id' => 'footer-nav',
            'depth' => 1,
            'fallback_cb' => 'bigblank_footer_menu_fallback',
        ));
    }

endif;

if (!function_exists('bigblank_menu_fallback')) :

    /**
     * Default menu fallback
     */
    function bigblank_menu_fallback() {
        $menus = wp_get_nav_menus();
        if (!empty($menus)) {
            return wp_nav_menu(array(
                'container' => 'nav',
                'depth' => 2,
                'container_id' => 'nav'
            ));
        }
    }

endif;

if (!function_exists('bigblank_footer_menu_fallback')) :

    /**
     * Footer menu fallback
     */
    function bigblank_footer_menu_fallback() {
        $menus = wp_get_nav_menus();
        if (!empty($menus)) {
            return wp_nav_menu(array(
                'container' => 'nav',
                'depth' => 1,
                'container_id' => 'footer-nav'
            ));
        }
    }

endif;

if (!function_exists('bigblank_paging_nav')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     *
     * @return void
     */
    function bigblank_paging_nav() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);
        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }
        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';
        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
        // Set up paginated links.
        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $GLOBALS['wp_query']->max_num_pages,
            'current' => $paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => __('&larr; Previous', 'bigblank'),
            'next_text' => __('Next &rarr;', 'bigblank'),
        ));
        if ($links) :
            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e('Posts navigation', 'bigblank'); ?></h1>
                <div class="pagination loop-pagination">
                    <?php echo $links; ?>
                </div><!-- .pagination -->
            </nav><!-- .navigation -->
            <?php
        endif;
    }

endif;

if (!function_exists('bigblank_post_nav')) :

    /**
     * Display navigation to next/previous post when applicable.
     *
     *
     * @return void
     */
    function bigblank_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);
        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e('Post navigation', 'bigblank'); ?></h1>
            <div class="nav-links">
                <?php
                if (is_attachment()) :
                    previous_post_link('%link', __('<span class="meta-nav">Published In</span>%title', 'bigblank'));
                else :
                    previous_post_link('%link', __('<span class="meta-nav">Previous Post</span>%title', 'bigblank'));
                    next_post_link('%link', __('<span class="meta-nav">Next Post</span>%title', 'bigblank'));
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('bigblank_posted_on')) :

    /**
     * Print HTML with meta information for the current post-date/time and author.
     *
     *
     * @return void
     */
    function bigblank_posted_on() {
        if (is_sticky() && is_home() && !is_paged()) {
            echo '<span class="featured-post">' . __('Sticky', 'bigblank') . '</span>';
        }
        // Set up and print post meta information.
        printf('<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>', esc_url(get_permalink()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), get_the_author()
        );
    }

endif;

/**
 * Find out if blog has more than one category.
 *
 *
 * @return boolean true if blog has more than 1 category
 */
function bigblank_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('bigblank_category_count') )) {
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories(array(
            'hide_empty' => 1,
        ));
        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count($all_the_cool_cats);
        set_transient('bigblank_category_count', $all_the_cool_cats);
    }
    if (1 !== (int) $all_the_cool_cats) {
        // This blog has more than 1 category so bigblank_categorized_blog should return true
        return true;
    } else {
        // This blog has only 1 category so bigblank_categorized_blog should return false
        return false;
    }
}

/**
 * Flush out the transients used in bigblank_categorized_blog.
 *
 *
 * @return void
 */
function bigblank_category_transient_flusher() {
    // Like, beat it. Dig?
    delete_transient('bigblank_category_count');
}

add_action('edit_category', 'bigblank_category_transient_flusher');
add_action('save_post', 'bigblank_category_transient_flusher');

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 *
 * @return void
 */
function bigblank_post_thumbnail() {
    if (post_password_required() || !has_post_thumbnail()) {
        return;
    }
    if (is_singular()) :
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('post-thumbnail', 'itemprop=image'); ?>
        </div>
    <?php else : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('post-thumbnail', 'itemprop=image'); ?>
        </a>
    <?php
    endif; // End is_singular()
}

/**
 *  post layout box
 */
function bigblank_layout_metabox($post) {

    wp_nonce_field('post_layout_nonce', '_wpnonce_post_layout');
    $post_layout = get_post_meta($post->ID, 'bigblank_post_layout', true);
    ?>
    <div class="layout image-radio-option theme-layout">
        <label class="description">
            <input type="radio" name="bigblank_post_layout"
                   value="default_layout" <?php checked($post_layout, false); ?> />
            Use Theme Default Layout
        </label>
    </div>
    <br />
    <?php
    foreach (bigblank_layouts() as $layout):
        ?>
        <div class="layout image-radio-option theme-layout">
            <label class="description">
                <input type="radio" name="bigblank_post_layout"
                       value="<?php echo esc_attr($layout['value']); ?>" <?php checked($post_layout, $layout['value']); ?> />
                <span>
                    <?php echo $layout['label']; ?>
                    <br />
                    <img src="<?php echo esc_url($layout['thumbnail']); ?>" width="136" height="122" alt="" />
                </span>
            </label>
        </div>
        <?php
    endforeach;
}

/**
 * add custom layout metaboxs
 * initiated from functions on after_setup_theme hook
 * add_action('add_meta_boxes', 'bigblank_add_custom_box');
 */
function bigblank_add_custom_box() {
    add_meta_box('bigblank_layout_box', __('Post Layout', 'bigblank'), 'bigblank_layout_metabox', 'post', 'side', 'core');
    add_meta_box('bigblank_layout_box', __('Page Layout', 'bigblank'), 'bigblank_layout_metabox', 'page', 'side', 'core');
}

/**
 * save post metabox data
 */
function bigblank_save_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (isset($_POST['_wpnonce_post_layout']) && !wp_verify_nonce($_POST['_wpnonce_post_layout'], 'post_layout_nonce'))
        return;

    if (isset($_POST['post_type']) && 'page' == $_POST['post_type'])
        if (!current_user_can('edit_page', $post_id))
            return;
        else
        if (!current_user_can('edit_post', $post_id))
            return;

    $post_layout = isset($_POST['bigblank_post_layout']) ? $_POST['bigblank_post_layout'] : '';
    if (array_key_exists($post_layout, bigblank_layouts())) {
        update_post_meta($post_id, 'bigblank_post_layout', $post_layout);
    } elseif ($post_layout == 'default_layout')
        delete_post_meta($post_id, 'bigblank_post_layout');
}

if (!function_exists('bigblank_get_layout')) :

    /**
     * get our theme layout (content, content-sidebar, sidebar-content)
     *
     * @return String Name of our theme layout
     */
    function bigblank_get_layout() {
        if (is_single() || is_page()) {
            $layout = get_post_meta(get_the_ID(), 'bigblank_post_layout', true);
            if (!$layout) {
                $options = bigblank_get_theme_options();
                $layout = $options['theme_layout'];
            }
        } else {
            $options = bigblank_get_theme_options();
            $layout = $options['theme_layout'];
        }
        return $layout;
    }

endif;

if (!function_exists('bigblank_has_sidebar')) :

    /**
     * Check layout to see if layout has a sidebar
     *
     * @return boolean
     */
    function bigblank_has_sidebar() {
        $layout = bigblank_get_layout();
        return ($layout == 'content-sidebar' || $layout == 'sidebar-content');
    }

endif;

/**
 * Check theme options for comments settings, and overwrite comments open
 * @link https://codex.wordpress.org/Function_Reference/comments_open
 * 
 * 
 * @param bool        $open    Whether the current post is open for comments.
 * @param int|WP_Post $post_id The post ID or WP_Post object.
 * @return boolean
 */
function bigblank_comments_open($open, $post_id) {
    $post = get_post($post_id);
    $options = bigblank_get_theme_options();

    if ('page' == $post->post_type) {
        $comments = $options['page_comments'];
    } else {
        $comments = $options['post_comments'];
    }
    if ($comments !== 'open') {
        $open = false;
    }
    return $open;
}

add_filter('comments_open', 'bigblank_comments_open', 10, 2);
