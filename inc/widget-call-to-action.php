<?php

/**
 * Big Blank Call to Action Widget
 *
 * I only have 3 word for you:
 * A. Always
 * B. BE
 * C. Closing
 * 
 */
class Call_To_Action_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'call_to_action_widget', // Root id for all widgets of this type.
                __('Call to Action Widget', 'bigblank'), // Name for this widget type.
                array('description' => __('A text widget with a Call to Action button.', 'bigblank'),)// Option array passed to wp_register_sidebar_widget()
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $content = apply_filters('widget_content', $instance['content']);
        $button_text = apply_filters('widget_button_text', $instance['button_text']);
        $button_link = apply_filters('widget_button_link', $instance['button_link']);
        $before_widget = $before_widget . '<div class="widget call2action">';
        $after_widget = '</div>' . $after_widget;

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        echo wpautop($content);
        echo '<a href="' . $button_link . '" class="button">' . $button_text . '</a>';
        echo $after_widget;
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = $new_instance['title'];
        $instance['content'] = $new_instance['content'];
        $instance['button_text'] = $new_instance['button_text'];
        $instance['button_link'] = $new_instance['button_link'];

        return $instance;
    }

    public function form($instance) {

        $title = isset($instance['title']) ? $instance['title'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $button_text = isset($instance['button_text']) ? $instance['button_text'] : __('Click Here', 'bigblank');
        $button_link = isset($instance['button_link']) ? $instance['button_link'] : __('#', 'bigblank');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bigblank'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:', 'bigblank'); ?></label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_attr($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'bigblank'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:', 'bigblank'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
        </p>
        <?php
    }

}
