<?php

/**
 * Big Blank Title Widget
 * 
 * Because sometimes all you need is just a title and nothing else.
 * @output <h4>$title</h4>
 */
class Title_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'title_widget', // Root id for all widgets of this type.
                __('Title Widget', 'bigblank'), // Name for this widget type.
                array('description' => __('Widget Adds Title with a Heading tag', 'bigblank'),) // Option array passed to wp_register_sidebar_widget()
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        if (!empty($title))
            echo '<h4>' . $title . '</h4>';
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags(trim($new_instance['title'])) : '';

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? strip_tags(trim($instance['title'])) : __('Title', 'bigblank');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bigblank'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

}
