<?php

/**
 * Add Schema.org based microdata information to our theme
 * 
 * Schema.org provides a collection of shared vocabularies webmasters can use 
 * to mark up their pages in ways that can be understood by the major 
 * search engines: Google, Microsoft, Yandex and Yahoo!
 * @link http://schema.org/
 */

/**
 * Display itemprop attribute of an item
 * @param string $itemprop Item Property in camelCase separated with a space.
 */
function itemprop($itemprop = '') {
    return 'itemprop="' . $itemprop . '"';
}

/**
 *
 * Display itemprop attribute of an item
 * @param string $itemtype Item Type in camelCase separated with a space.
 * 
 * Full list of the Type Hierarchy
 * @link http://schema.org/docs/full.html
 */
function itemtype() {
    if (is_front_page() || is_page() || is_404()) {
        $itemtype = 'WebPage';
    } elseif (is_home() || is_archive()) {
        $itemtype = 'Blog';
    } elseif (is_search()) {
        $itemtype = 'search';
    } elseif (is_page('contact')) { /* Change the slug to your contact page */
        $itemtype = 'ContactPage';
    } elseif (is_page('about')) { /* Change the slug to your about page */
        $itemtype = 'AboutPage';
    } elseif (is_author()) {
        $itemtype = 'ProfilePage';
    } elseif (is_search()) {
        $itemtype = 'SearchResultsPage';
    } elseif (is_single()) {
        $itemtype = 'BlogPosting';
    } else {
        $itemtype = 'Thing';
    }
    return $itemtype;
}

/**
 * Display theme microdata tags
 * 
 * @param string $itemprop Item Property in camelCase separated with a space.
 * @param string $itemtype Item Type in camelCase separated with a space.
 */
function schema($itemprop = '', $itemtype = '') {
    if (empty($itemprop)) {
        if (empty($itemtype)) {
            $itemtype = itemtype();
        }
        $schema .= 'itemscope="" itemtype="http://schema.org/' . $itemtype . '"';
    } else {
        $schema = itemprop($itemprop);
    }
    echo $schema;
}
