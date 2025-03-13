<?php 
    /*--------------------------------------------------------------------------
     * ====== COMMON / EXTRA SETUPS ======
     * CAUTION!!! do NOT including via load_theme_partial (lose funcs effects)
     * -------------------------------------------------------------------------
    */
    include_once(get_template_directory() . '/inc/common_setup.php');
    include_once(get_template_directory() . '/inc/extra_setup.php');

    // 添加标签链接过滤器
    add_filter('tag_link', 'modify_tag_link', 10, 2);
    function modify_tag_link($tag_link, $tag_id) {
        return str_replace('/tag/', '/index.php/tag/', $tag_link);
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