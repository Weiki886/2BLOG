<?php
/*
    Template Name: 文章模板
    Template Post Type: post, news
*/
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link type="text/css" rel="stylesheet" href="<?php custom_cdn_src(); ?>/style/articles.css?v=<?php echo get_theme_info('Version'); ?>" />
    <?php get_head(); ?>
    <link type="text/css" rel="stylesheet" href="<?php custom_cdn_src(); ?>/style/fancybox.css?v=<?php echo get_theme_info('Version'); ?>" />
    <style>
        .news-article-container figure{margin:5px}
        figure > figure{width:30%;vertical-align:middle}
    </style>
</head>
<body class="<?php theme_mode(); ?>">
<div class="content-all">
    <header>
        <nav id="tipson" class="ajaxloadon">
            <?php get_header(); ?>
        </nav>
    </header>
    <div class="content-all-windows">
        <div class="news-article-window<?php 
            $fullview = array_key_exists('article_fullview',$_COOKIE) ? $_COOKIE['article_fullview'] : false;
            $fontsize = array_key_exists('article_fontsize',$_COOKIE) ? $_COOKIE['article_fontsize'] : false;
            echo $fullview ? " fullview" : ""; 
        ?>">
            <?php breadcrumb_switch(false,true); ?>
            <div class="news-article-core">
                <div class="news-article-inside">
                    <div id="news-article-head">
                        <div class="news-article-head-tools">
                            <div class="tools-inside-block">
                                <span id="full-view" title="满屏切换">
                                    <em><?php if($fullview) echo "Sideview";else echo "Overview";?></em>
                                </span>
                                <span id="font-plus" title="字体大小">
                                    <em><?php if($fontsize) echo "A-";else echo "A+"; ?></em>
                                </span>
                                <!--<span id="s2t2s-switch" title="简繁切换"><em>简</em></span>-->
                                <?php $rights = get_post_meta($post->ID, "post_rights", true);if($rights&&$rights!='请选择') echo '<span id="copyright-sign" title="版权声明"><em>' . $rights . '</em></span>'; ?>
                            </div>
                        </div>
                        <h1> <?php the_title(); ?> </h1>
                        <div id="news-article-head_tail">
                            <span class="article-copyright-notice"><q>文章由<?php $source = get_post_meta($post->ID, "post_source", true);if($source!="") echo '<a href="/">'.$source.'</a>';else echo '<a href="/">'.get_option("site_nick").'</a>';?> 创作，遵循 <?php echo get_option("site_copyright") ?> 协议</q></span>
                            <ul>
            	  	            <!--<li id="post-level" title="时态等级"><i class="icom"></i>L-LV</li>-->
            	  	            <li id="post-views" title="浏览信息"><i class="icom"></i><?php $cat=get_the_ID();setPostViews($cat);echo getPostViews($cat); ?>
                              </li>
            	  	            <li id="post-date" title="发布日期"><i class="icom"></i><?php the_time('d-m-Y'); ?></li>
            	  	          </ul>
                        </div>
                    </div>
                    <div class="news-article-container<?php if($fontsize) echo " AfontPlus"; ?>">
                        <div class="content">
                            <?php the_content()//echo get_postimg(); ?>
                        </div>
                        <br />
                        <h5> 本文完结 </h5>
                        <?php 
                            //https://stackoverflow.com/questions/7052297/wp-list-comments-not-working
                            dual_data_comments();  // query comments from database before include
                            //DO NOT INCLUDE AFTER CALLING comments_template, cause fatal error,called twice
                            // include_once(TEMPLATEPATH . '/comments.php')
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-slidebar-window<?php if($fullview) echo " fv-switch"; ?>">
            <?php get_sidebar(); ?>
        </div>
    </div>
    <footer>
        <?php get_footer(); ?>
    </footer>
</div
<!-- siteJs-->
<script type="text/javascript" src="<?php custom_cdn_src(); ?>/js/main.js?v=<?php echo get_theme_info('Version'); ?>"></script>
<!-- pluginJs-->
<!--<script type="text/javascript" src="<?php custom_cdn_src(); ?>/js/s2t.js"></script>-->
<!-- inHtmlJs -->
<script src="<?php custom_cdn_src(); ?>/js/fancybox.umd.js"></script>
<script>
    // gallery js initiate 'bodyimg' already exists in footer lazyload, use contimg insted.
    const contimg = document.querySelectorAll(".news-article-container .content img");
    if(contimg.length>=1){
        for(let i=0;i<contimg.length;i++){
            let eachimg = contimg[i],
                datasrc = eachimg.dataset.src,
                imgbox = document.createElement("a");
            imgbox.setAttribute("data-fancybox","gallery");
            imgbox.setAttribute("href", datasrc);
            eachimg.parentNode.insertBefore(imgbox, eachimg);
            imgbox.appendChild(eachimg);
        }
    }
</script>
</body></html>