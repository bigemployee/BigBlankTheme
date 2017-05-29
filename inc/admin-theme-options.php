<?php
/**
 * Big Blank Theme Options
 *
 */

/**
 * enqueue styles and scripts for admin option page
 */
function bigblank_admin_enqueue_scripts($hook_suffix) {
    wp_enqueue_style('bigblank-theme-options', get_template_directory_uri() . '/css/admin-theme-options.css', false);
}

add_action('admin_print_styles-appearance_page_theme_options', 'bigblank_admin_enqueue_scripts');

/**
 * register form setting for options array
 */
function bigblank_theme_options_init() {
    register_setting('bigblank_options', 'bigblank_theme_options', 'bigblank_theme_options_validate');

    // register settings field group
    add_settings_section('contact', __('Contact Settings', 'bigblank'), '__return_false', 'theme_options');
    add_settings_section('social', __('Social Media Links', 'bigblank'), '__return_false', 'theme_options');
    add_settings_section('general', __('General Layout Settings', 'bigblank'), '__return_false', 'theme_options');
    add_settings_section('footer', __('Footer Settings', 'bigblank'), '__return_false', 'theme_options');

    add_settings_field('contact-phone', __('Phone Number', 'bigblank'), 'bigblank_settings_field_phone', 'theme_options', 'contact', array('label_for' => 'contact-phone'));
    add_settings_field('contact-address', __('Address', 'bigblank'), 'bigblank_settings_field_address', 'theme_options', 'contact', array('label_for' => 'contact-address'));
    add_settings_field('social-twitter', __('Twitter', 'bigblank'), 'bigblank_settings_field_twitter', 'theme_options', 'social', array('label_for' => 'social-twitter'));
    add_settings_field('social-facebook', __('Facebook', 'bigblank'), 'bigblank_settings_field_facebook', 'theme_options', 'social', array('label_for' => 'social-facebook'));
    add_settings_field('social-googleplus', __('Google+', 'bigblank'), 'bigblank_settings_field_googleplus', 'theme_options', 'social', array('label_for' => 'social-googleplus'));
    add_settings_field('social-instagram', __('Instagram', 'bigblank'), 'bigblank_settings_field_instagram', 'theme_options', 'social', array('label_for' => 'social-instagram'));
    add_settings_field('social-youtube', __('Youtube', 'bigblank'), 'bigblank_settings_field_youtube', 'theme_options', 'social', array('label_for' => 'social-youtube'));
    add_settings_field('social-pinterest', __('Pinterest', 'bigblank'), 'bigblank_settings_field_pinterest', 'theme_options', 'social', array('label_for' => 'social-pinterest'));
	    add_settings_field('social-whatsapp', __('Whatsapp', 'bigblank'), 'bigblank_settings_field_pinterest', 'theme_options', 'social', array('label_for' => 'social-whatsapp'));
    add_settings_field('layout', __('Default Layout', 'bigblank'), 'bigblank_settings_field_layout', 'theme_options', 'general');
    add_settings_field('comments', __('Comment Settings', 'bigblank'), 'bigblank_settings_field_comments', 'theme_options', 'general');
    add_settings_field('footer-copyright', __('Footer Copyright', 'bigblank'), 'bigblank_settings_field_footer_copyright', 'theme_options', 'footer', array('label_for' => 'footer-copyright'));
    add_settings_field('footer-text', __('Footer Text', 'bigblank'), 'bigblank_settings_field_footer_text', 'theme_options', 'footer', array('label_for' => 'footer-text'));
    add_settings_field('footer-analytics', __('Analytics JavaScript', 'bigblank'), 'bigblank_settings_field_footer_analytics', 'theme_options', 'footer', array('label_for' => 'footer-analytics'));
}

add_action('admin_init', 'bigblank_theme_options_init');

/**
 * change capability to save bigblank_options
 */
function bigblank_options_page_capability($capability) {
    return 'edit_theme_options';
}

add_filter('option_page_capability_bigblank_options', 'bigblank_options_page_capability');

/**
 * Add options page
 */
function bigblank_theme_options_add_page() {
    $theme_page = add_theme_page(
            __('Theme Options', 'bigblank'), // name of page
            __('Theme Options', 'bigblank'), // label in menu
            'edit_theme_options', // capability required
            'theme_options', // unique menu slug
            'bigblank_theme_options_render_page' // render function
    );
    if (!$theme_page)
        return;
    add_action("load-$theme_page", 'bigblank_theme_options_help');
}

add_action('admin_menu', 'bigblank_theme_options_add_page');

/**
 * Add theme specific contextual help
 */
function bigblank_theme_options_help() {

    $help = '<p>' . __('Few notes about these Theme Options:', 'bigblank') . '</p>' .
            '<p>' . __('Page and Post layout settings overwrite these Theme Option settings.', 'bigblank') . '</p>' .
            '<p>' . __('Comment settings in Theme Options overwrite the individual Page and Post settings:', 'bigblank') . '</p>' .
            '<p>' . __('Remember to click "Save Changes" to save any changes you have made to the theme options.', 'bigblank') . '</p>';

    $sidebar = '<p><strong>' . __('For more information:', 'bigblank') . '</strong></p>' .
            '<p>' . __('<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'bigblank') . '</p>' .
            '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'bigblank') . '</p>';

    $screen = get_current_screen();

    if (method_exists($screen, 'add_help_tab')) {
        $screen->add_help_tab(array(
            'title' => __('Overview', 'bigblank'),
            'id' => 'theme-options-help',
            'content' => $help,
        ));

        $screen->set_help_sidebar($sidebar);
    }
}

/**
 * returns an array of layout options
 */
function bigblank_layouts() {
    $layout_options = array(
        'content-sidebar' => array(
            'value' => 'content-sidebar',
            'label' => __('Content on left', 'bigblank'),
            'thumbnail' => get_template_directory_uri() . '/images/content-sidebar.png'
        ),
        'sidebar-content' => array(
            'value' => 'sidebar-content',
            'label' => __('Content on right', 'bigblank'),
            'thumbnail' => get_template_directory_uri() . '/images/sidebar-content.png'
        ),
        'content' => array(
            'value' => 'content',
            'label' => __('One-column, no sidebar', 'bigblank'),
            'thumbnail' => get_template_directory_uri() . '/images/content.png'
        )
    );
    return apply_filters('bigblank_layouts', $layout_options);
}

/**
 * return default theme options
 */
function bigblank_get_default_theme_options() {
    $default_theme_options = array(
        'phone' => '',
        'address' => '',
        'twitter' => '',
        'facebook' => '',
        'googleplus' => '',
        'instagram' => '',
        'youtube' => '',
        'pinterest' => '',
		'whatsapp' => '',
        'theme_layout' => 'content-sidebar',
        'page_comments' => 'on',
        'post_comments' => 'on',
        'footer_copyright' => __('Copyright', 'bigblank') . ' &copy; ' . date("Y") . ' <a href="' . site_url() . '">' . get_bloginfo('name') . '</a>',
        'footer_text' => sprintf(__('Proudly powered by %s', 'bigblank'), '<a href="http://wordpress.org">WordPress</a>'),
        'footer_analytics' => ''
    );
    return apply_filters('bigblank_default_theme_options', $default_theme_options);
}

/**
 * @return array of theme options
 */
function bigblank_get_theme_options() {
    return get_option('bigblank_theme_options', bigblank_get_default_theme_options());
}

/**
 * render the phone settings
 */
function bigblank_settings_field_phone() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="contact-phone" name="bigblank_theme_options[phone]" value="<?php echo esc_attr($options['phone']); ?>" />
    <?php
}

/**
 * render the address settings
 */
function bigblank_settings_field_address() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="contact-address" name="bigblank_theme_options[address]" value="<?php echo esc_attr($options['address']); ?>" />
    <?php
}

/**
 * render the twitter settings
 */
function bigblank_settings_field_twitter() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-twitter" name="bigblank_theme_options[twitter]" value="<?php echo esc_attr($options['twitter']); ?>" />
    <?php
}

/**
 * render the facebook settings
 */
function bigblank_settings_field_facebook() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-facebook" name="bigblank_theme_options[facebook]" value="<?php echo esc_attr($options['facebook']); ?>" />
    <?php
}

/**
 * render the google+ settings
 */
function bigblank_settings_field_googleplus() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-googleplus" name="bigblank_theme_options[googleplus]" value="<?php echo esc_attr($options['googleplus']); ?>" />
    <?php
}

/**
 * render the instagram settings
 */
function bigblank_settings_field_instagram() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-instagram" name="bigblank_theme_options[instagram]" value="<?php echo esc_attr($options['instagram']); ?>" />
    <?php
}

/**
 * render the youtube settings
 */
function bigblank_settings_field_youtube() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-youtube" name="bigblank_theme_options[youtube]" value="<?php echo esc_attr($options['youtube']); ?>" />
    <?php
}

/**
 * render the pinterest settings
 */
function bigblank_settings_field_pinterest() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-pinterest" name="bigblank_theme_options[pinterest]" value="<?php echo esc_attr($options['pinterest']); ?>" />
    <?php
}

/**
 * render the whatsapp settings
 */
function bigblank_settings_field_whatsapp() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="social-whatsapp" name="bigblank_theme_options[whatsapp]" value="<?php echo esc_attr($options['whatsapp']); ?>" />
    <?php
}

/**
 * render the default layout setting field
 */
function bigblank_settings_field_layout() {
    $options = bigblank_get_theme_options();
    foreach (bigblank_layouts() as $layout):
        ?>
        <div class="layout image-radio-option theme-layout">
            <label class="description">
                <input type="radio" name="bigblank_theme_options[theme_layout]"
                       value="<?php echo esc_attr($layout['value']); ?>" <?php checked($options['theme_layout'], $layout['value']); ?> />
                <span>
                    <img src="<?php echo esc_url($layout['thumbnail']); ?>" width="136" height="122" alt="" />
                    <?php echo $layout['label']; ?>
                </span>
            </label>
        </div>
        <?php
    endforeach;
}

/**
 * returns an array of layout options
 */
function bigblank_comment_options() {
    $comment_options = array(
        'page-comments' => array(
            'key' => 'page_comments',
            'label' => __('Show Comments on Pages', 'bigblank')
        ),
        'post-comments' => array(
            'key' => 'post_comments',
            'label' => __('Show Comments on Posts', 'bigblank')
        )
    );
    return apply_filters('bigblank_comment_options', $comment_options);
}

/**
 * render the default comments setting field
 */
function bigblank_settings_field_comments() {
    $options = bigblank_get_theme_options();
    foreach (bigblank_comment_options() as $comment):
        ?>
        <div class="commnet checkbox-input theme-comment">
            <label class="description">
                <input type="checkbox" name="bigblank_theme_options[<?php echo esc_attr($comment['key']) ?>]"
                       <?php checked($options[$comment['key']], 'on'); ?>  />
                <span>
                    <?php echo $comment['label']; ?>
                </span>
            </label>
        </div>
        <?php
    endforeach;
}

/**
 * render the footer copyright settings field
 */
function bigblank_settings_field_footer_copyright() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="footer-copyright" name="bigblank_theme_options[footer_copyright]" value="<?php echo esc_attr($options['footer_copyright']); ?>" />
    <?php
}

/**
 * render the footer text settings field
 */
function bigblank_settings_field_footer_text() {
    $options = bigblank_get_theme_options();
    ?>
    <input type="text" class="large-text" id="footer-text" name="bigblank_theme_options[footer_text]" value="<?php echo esc_attr($options['footer_text']); ?>" />
    <?php
}

/**
 * render the footer Analytics Javascript
 */
function bigblank_settings_field_footer_analytics() {
    $options = bigblank_get_theme_options();
    ?>
    <textarea class="large-text" rows="5" id="footer-analytics" name="bigblank_theme_options[footer_analytics]"/><?php echo esc_attr($options['footer_analytics']); ?></textarea>
    <?php
}

/**
 * @return rendered options page
 */
function bigblank_theme_options_render_page() {
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <?php $theme_name = wp_get_theme(); ?>
        <h2><?php printf(__('%s Options', 'bigblank'), $theme_name); ?></h2>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php
            settings_fields('bigblank_options');
            do_settings_sections('theme_options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * validate form input
 */
function bigblank_theme_options_validate($input) {
    $output = $defaults = bigblank_get_default_theme_options();

    if (isset($input['phone'])) {
        $output['phone'] = $input['phone'];
    }
    if (isset($input['address'])) {
        $output['address'] = $input['address'];
    }
    if (isset($input['twitter'])) {
        $output['twitter'] = $input['twitter'];
    }
    if (isset($input['facebook'])) {
        $output['facebook'] = $input['facebook'];
    }
    if (isset($input['googleplus'])) {
        $output['googleplus'] = $input['googleplus'];
    }
    if (isset($input['instagram'])) {
        $output['instagram'] = $input['instagram'];
    }
    if (isset($input['youtube'])) {
        $output['youtube'] = $input['youtube'];
    }
    if (isset($input['pinterest'])) {
        $output['pinterest'] = $input['pinterest'];
    }
	if (isset($input['whatsapp'])) {
        $output['whatsapp'] = $input['whatsapp'];
    }
    if (isset($input['theme_layout']) && array_key_exists($input['theme_layout'], bigblank_layouts())) {
        $output['theme_layout'] = $input['theme_layout'];
    }
    if (array_key_exists('page_comments', $input)) {
        $output['page_comments'] = $input['page_comments'];
    } else {
        $output['page_comments'] = '';
    }
    if (array_key_exists('post_comments', $input)) {
        $output['post_comments'] = $input['post_comments'];
    } else {
        $output['post_comments'] = '';
    }
    if (isset($input['footer_copyright'])) {
        $output['footer_copyright'] = $input['footer_copyright'];
    }
    if (isset($input['footer_text'])) {
        $output['footer_text'] = $input['footer_text'];
    }
    if (isset($input['footer_analytics'])) {
        $output['footer_analytics'] = $input['footer_analytics'];
    }

    return apply_filters('bigblank_theme_options_validate', $output, $input, $defaults);
}

/**
 * Execute Analytics code further down the page
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
 */
function bigblank_theme_options_render_analytics() {
    $options = bigblank_get_theme_options();
    echo $options['footer_analytics'];
}

add_action('wp_footer', 'bigblank_theme_options_render_analytics', 100);
