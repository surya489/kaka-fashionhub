<?php

/**
 * ACF Optimise
 */
function acf_json_loc($path) {
    $path = get_stylesheet_directory() . '/acf_db/files';
    return $path;
}
add_filter('acf/settings/save_json', 'acf_json_loc');

function acf_json_load($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf_db/files';
    return $paths;
}
add_filter('acf/settings/load_json', 'acf_json_load');


/**
 * Cache posts & media
 */
function get_acf_ids(&$ids, $field_id, $repeater_id = false, $depends = false) {
    if ($repeater_id === false) {
        //If not inside a repeater
        $ids[] = (int) get_field($field_id);
    } else {
        while (have_rows($repeater_id)) : the_row();
            if ($depends === false)
                $ids[] = (int) get_sub_field($field_id);
            else
                $ids[] = (int) get_sub_field($field_id . "_" . get_sub_field($depends));
        endwhile;
    }

    return $ids;
}

function get_acf_cache($post_ids) {
    if (count($post_ids))
        $posts = get_posts(array('post_type' => 'any', 'numberposts' => -1, 'post__in' => $post_ids));
}


/**
 * Disable Emoji
 */
function disable_emojicons_tinymce($plugins) {
    if (is_array($plugins))
        return array_diff($plugins, array('wpemoji'));
    else
        return array();
}

function disable_wp_emojicons() {
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');