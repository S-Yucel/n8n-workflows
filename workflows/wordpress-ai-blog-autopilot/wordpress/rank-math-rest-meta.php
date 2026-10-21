<?php
/**
 * Plugin Name: Rank Math REST Meta
 * Description: Lets authenticated REST API clients (e.g. n8n) read and write Rank Math's
 *              SEO title, description and focus keyword on posts.
 * Install:     upload this file to wp-content/mu-plugins/ (no activation needed).
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', function () {
    $keys = ['rank_math_title', 'rank_math_description', 'rank_math_focus_keyword'];
    foreach ($keys as $key) {
        register_post_meta('post', $key, [
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback'     => function () {
                return current_user_can('edit_posts');
            },
        ]);
    }
});
