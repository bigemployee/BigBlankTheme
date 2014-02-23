<?php
/**
 * Functions to facilitate content manipulation and shortcodes
 */
/**
 * A simple button shortcode, with option to pass link and additional class
 * [button link="http://bigemployee.com/" class="big"]Big Employee[/button]
 * Output:
 * <a href="http://bigemployee.com/" class="button big">Big Employee</a>
 */
function bigblank_add_shortcode_button($atts, $content = null) {
    extract(
            shortcode_atts(
                    array(
        'link' => '#',
        'class' => 'button',
                    ), $atts));
    $content = parse_shortcode_content($content);
    return bigblank_render_button($content, $link, false, $class);
}

function bigblank_render_button($content = 'new link', $link = '#', $echo = true, $class = 'button') {
    $class = strip_tags(trim($class));
    if (strpos($class, 'button') === FALSE) {
        $class = 'button ' . $class;
    }
    if (!$echo)
        return '<a href="' . $link . '" class="' . $class . '">' . do_shortcode($content) . '</a>';
    echo '<a href="' . $link . '" class="' . $class . '">' . do_shortcode($content) . '</a>';
}

add_shortcode('button', 'bigblank_add_shortcode_button');

// This function adds nice anchor with id attribute to our h2 tags for reference
// Ref: http://www.w3.org/TR/html4/struct/links.html#h-12.2.3

function replace_content($content) {

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

add_filter('the_content', 'replace_content');

// Hide Email from Spam Bots using a short code place this in your functions file
// http://codex.wordpress.org/Function_Reference/antispambot
// [email]john.doe@mysite.com[/email]
// Output: &#106;&#111;h&#110;&#46;&#100;&#111;&#101;&#64;mysit&#101;.&#99;&#111;&#109;
function HideMail($atts , $content = null ){
	if ( ! is_email ($content) )
		return;

	return '<a href="mailto:'.antispambot($content).'">'.antispambot($content).'</a>';
}
add_shortcode( 'email','HideMail');