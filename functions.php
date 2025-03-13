<?php 
    /*--------------------------------------------------------------------------
     * ====== COMMON / EXTRA SETUPS ======
     * CAUTION!!! do NOT including via load_theme_partial (lose funcs effects)
     * -------------------------------------------------------------------------
    */
    include_once(get_template_directory() . '/inc/common_setup.php');
    include_once(get_template_directory() . '/inc/extra_setup.php');

    // 添加标签链接过滤器，确保所有标签链接都包含index.php
    add_filter('tag_link', 'modify_tag_link', 10, 2);
    function modify_tag_link($tag_link, $tag_id) {
        // 检查链接中是否已包含index.php，如果没有则添加
        if (strpos($tag_link, '/index.php/') === false) {
            return str_replace('/tag/', '/index.php/tag/', $tag_link);
        }
        return $tag_link;
    }
    
    // 添加更多过滤器以确保所有可能的标签链接都被修改
    add_filter('term_link', 'modify_term_link', 10, 3);
    function modify_term_link($term_link, $term, $taxonomy) {
        if ($taxonomy === 'post_tag' && strpos($term_link, '/index.php/') === false) {
            return str_replace('/tag/', '/index.php/tag/', $term_link);
        }
        return $term_link;
    }

    /*--------------------------------------------------------------------------
     * ====== THEME PANEL CONTROLS ======
     * https://themes.artbees.net/blog/custom-setting-page-in-wordpress/
     * -------------------------------------------------------------------------
    */
    if(is_admin()) {
        include_once(get_template_directory() . '/inc/theme_settings.php');
    }
?>