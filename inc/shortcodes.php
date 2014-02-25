<?php

/**
 * Big Blank Custom Shortcodes
 * @link http://codex.wordpress.org/Shortcode_API
 */

/**
 * A simple button shortcode, with option to pass link and additional class
 * [button link="http://bigemployee.com/" class="big"]Big Employee[/button]
 * @return: <a href="http://bigemployee.com/" class="button big">Big Employee</a>
 */
function bigblank_add_shortcode_button($atts, $content = null) {
    extract(
            shortcode_atts(
                    array(
        'link' => '#',
        'class' => 'button',
                    ), $atts));
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

/*
 * Hide Email from Spam Bots using a short code place this in your functions file
 * [email]john.doe@mysite.com[/email]
 * Output: &#106;&#111;h&#110;&#46;&#100;&#111;&#101;&#64;mysit&#101;.&#99;&#111;&#109;
 * 
 * @link http://codex.wordpress.org/Function_Reference/antispambot
*/
function bigblank_hide_email($atts, $content = null) {
    if (!is_email($content))
        return;

    return '<a href="mailto:' . antispambot($content) . '">' . antispambot($content) . '</a>';
}

add_shortcode('email', 'bigblank_hide_email');