<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo $src_cdn; ?>/style/main.min.css?v=<?php echo get_theme_info('Version'); ?>" />
    <?php include_once(TEMPLATEPATH. '/head.php'); ?>
    <style>
        #banner-prev,#banner-next{
            cursor: pointer;
            background:url("<?php echo $img_cdn; ?>/images/css_sprites.png") no-repeat;
        }
        .banner .banner-inside ul{cursor:grab;}
        #special-img{
            position: absolute;
            top: 0;
            /*left: 15px;*/
            /*left: 0;*/
            /*right: auto;*/
            right: 0;
            height: 100%;
            /*animation: dancing ease-in-out 2.5s 0s infinite;*/
            /*animation-fill-mode: both;*/
            min-width: 256px;
            max-width: 538px;
        }
        #special-img video{
            height: 100%;
            width: 100%;
            border-radius: inherit;
            object-fit: cover;
        }
        .acg_window-content-inside_right::before{
            opacity: .5;
            content: none;
        }
        .main-bottom-ta{
            display: block;
        }
        .Fresh-ImgBoxs span a{
            font-family: cursive,monospace,serif,fangsong;
            font-size: 4.5em;
            padding: 10% 0;
        }
        .Fresh-ImgBoxs span i{
            font-size: 7rem;
            right: -15%;
        }
        .resource-windows div{
            /*margin: 15px 15px auto auto;*/
            margin: 15px 25px auto auto;
        }
        /*.recommendation{margin-left:25px;}*/
        /*.resource-windows div:first-child{*/
        /*    margin-left: auto;*/
        /*}*/
        /*.special-display ul:hover #special-img{*/
        /*    width: 36%;*/
        /*}*/
        /*body.dark .banner .banner-inside ul{*/
        /*    filter: invert(1);*/
        /*}*/
        @keyframes colorfull{
            0%{
                filter: hue-rotate(0deg);
            }
            100%{
                filter: hue-rotate(360deg);
            }
        }
        .banner .banner-inside ul{
            max-height: 268px;
            /*filter: invert(1);*/
            /*animation: colorfull ease 3s .5s;*/
        }
        <?php
            $baas = get_option('site_leancloud_switcher');
            $weblog = get_option('site_techside_switcher');
            if($weblog) echo '.special-display{width:30.5%;/*width:32%*/}';
        ?>
    </style>
</head>
<body class="<?php theme_mode(); ?>">
<div class="content-all">
<div class="main-content">
<header>
    <nav id="tipson" class="ajaxloadon">
        <?php get_header(); ?>
    </nav>
</header>
<!-- 顶 -->
<?php get_inform(); ?>
<div class="main-top-allpart flexboxes">
    <div class="main-top-part flexboxes" <?php if(!get_option("site_inform_switcher")) echo 'style="margin-top:15px"'; ?>>
        <!-- 左 -->
        <div class="weBlog-banner flexboxes wow fadeInUp" data-wow-delay="0.1s">
            <div class="weBlog-Description" style="margin-top:0;">
                <div class="weBlog-Description-inside">
                    <div class="weBlog-Description-inside-content">
                        <span>
                            <small><strong> <?php echo get_option('site_nick', get_bloginfo('name')); ?> </strong></small>
                            <p> 「<?php bloginfo('description') ?>」 </p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="banner">
                <div class="banner-inside">
                    <ul>
                        <!--<li style="background: url('https://api.luvying.com/acgimg') no-repeat center center /cover;"></li>-->
                        <?php
                            $banner_array = explode(',',get_option('site_banner_array',''));
                            $banner_array_count = count($banner_array);
                            for($i=0;$i<$banner_array_count;$i++){
                                $image_url = trim($banner_array[$i]);
                                if($image_url) echo '<li style="background: url('.$image_url.') no-repeat center center /cover;"></li>';
                            }
                        ?>
                        <!--<li><?php //the_countdown_widget('2023/01/14,00:00:00','自定义定时器/定时完成','https://img.2broear.com/images/1llusion.gif'); ?></li>-->
                    </ul>
                    <div class="switcher">
                        <span id="banner-prev" class="banner_prew"></span>
                        <span id="banner-next" class="banner_next"></span>
                    </div>
                    <div class="dots"></div>
                </div>
            </div>
        </div>
        <!-- 右 -->
        <div class="recommendation wow fadeInUp hfeed" data-wow-delay="0.2s">
            <?php
                $rcmd_query = new WP_Query(array_filter(array('cat' => get_option('site_rcmdside_cid'), 'meta_key' => 'post_orderby', 'posts_per_page' => 1,
                    'orderby' => array(
                        'meta_value_num' => 'DESC',
                        'date' => 'DESC',
                        'modified' => 'DESC',
                    )
                )));
                while ($rcmd_query->have_posts()):
                    $rcmd_query->the_post();
                    $post_feeling = get_post_meta($post->ID, "post_feeling", true);
                    $post_orderby = get_post_meta($post->ID, "post_orderby", true);
            ?>
                    <article class="<?php if($post_orderby>1) echo 'topset'; ?> article" id="recommend-inside">
                      <div class="recommend-newsImg">
                        <div>
                          <a href="<?php the_permalink() ?>" aria-label="bg">
                            <span id="lowerbg" style="background:url('<?php echo get_postimg(0,$post->ID,true); ?>') center 40% no-repeat;background-size:cover;"></span>
                          </a>
                          <a href="<?php the_permalink() ?>" id="rel" rel="bookmark" target="_blank">
                            <b><?php the_title() ?></b>
                          </a>
                        </div>
                      </div>
                      <div class="recommend-newsContent">
                        <span class="content-core entry-content">
                            <p><?php custom_excerpt(150);  //echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                        </span>
                        <span class="content-tail">
                          <aside class="personal_stand">
                            <p><?php echo $post_feeling ? $post_feeling : " ...... "; ?></p>
                          </aside>
                        </span>
                      </div>
                    </article>
            <?php
                endwhile;
                wp_reset_query();  // reset wp query incase following code occured query err
            ?>
        </div>
    </div>
</div>
    <div class="main-top-part pixiv flexboxes wow fadeInUp" data-wow-delay="0.2s">
        <div class="Fresh-ImgBoxs flexboxes">
          <?php
              $cardnav_array = explode(';', get_option('site_cardnav_array'));
              $cardnav_array_count = count($cardnav_array);
              for($i=0;$i<$cardnav_array_count;$i++){
                  $each_card = explode('/', $cardnav_array[$i]);
                  if($each_card[0]){
                      $card_slug = trim($each_card[0]);
                      $card_nick = trim($each_card[1]);
                      $card_term = get_category_by_slug($card_slug) ? get_category_by_slug($card_slug) : get_category(1);  // 1 for UNCATEGORIZED
                      if(!$card_nick) $card_nick=get_category_by_slug($card_slug)->name;  //incase non diy nick
                      if($card_slug){  //incase end with ";"
                        echo '<span class="'.$card_slug.'"><a href="'.get_category_link($card_term->term_id).'"> '.$card_nick.'<i class="icom icon-'.$card_slug.'"></i></a></span>';
                      }
                  }
              }
          ?>
        </div>
    </div>
    <div class="main-top-part flexboxes wow fadeInUp" data-wow-delay="0.3s">
        <!-- 右 -->
        <div class="resource-windows flexboxes">
            <?php
                $load_arr = [get_cat_by_template('news'), get_cat_by_template('notes')];
                if($weblog)  array_push($load_arr, get_cat_by_template('weblog'));
                $load_arr_count = count($load_arr);
                for($i=0;$i<$load_arr_count;$i++){
            ?>
                <div id="news-window">
                    <span class='resource-windows-top'>
                        <span class='resource-windows-top_inside'><!--<span id="icon-resource"></span>--></span>
                        <h3><?php echo $load_arr[$i]->name; ?></h3>
                    </span>
                    <ul class="news-list" id="mainNews">
                        <?php recent_posts_query($load_arr[$i]->term_id, true ,false ,6); ?>
                    </ul>
                </div>
            <?php
                }
            ?>
        </div>
        <!-- 左 -->
        <div class="special-display">
            <ul class="flexboxes">
                <li id="special-img" style="background: url() center /cover;">
                    <video src="<?php echo get_option('site_list_bg'); ?>" poster="<?php echo get_option('site_list_bg'); ?>" preload="" autoplay="" muted="" loop="" x5-video-player-type="h5" controlslist="nofullscreen nodownload"></video>
                </li>
            </ul>
        </div>
    </div>
    <!--<div class="main-middle-allpart"></div>-->
    <div class="main-bottom-allpart">
        <!-- 左文窗 ，右图-->
        <div class="main-bottom-ta">
        <?php
            if(!$weblog){
                
        ?>
            <div id="tech-acg-inside_tech" class="flexboxes wow fadeInUp" data-wow-delay="0.15s">
                <span id="tech_window" style="width:100%">
                    <div class="newsBox-supTitle flexboxes" id="tech_window-top">
                        <span class="newsBox-supTitle-iDescription" id="icon-technology">
                            <em>LOG</em><i class="icom icon-weblog"></i>
                        </span>
                        <h2><?php echo $blog_temp = get_cat_by_template('weblog')->name;//echo strtoupper($blog_temp->slug).'「'.$blog_temp->name.'」'; ?></h2>
                    </div>
                    <ul class="tech_window-content">
                        <?php 
                            $query_cid = get_option('site_techside_cid');
                            $baas&&strpos(get_option('site_leancloud_category'), 'category-weblog.php')!==false ? avos_posts_query($query_cid,".tech_window-content") : recent_posts_query($query_cid);
                        ?>
                    </ul>
                    <div class="newsBox-subText-Description" id="tech_window-bottom">
                        <?php
                            // $query_str = get_template_bind_cat('category-weblog.php')->slug;
                            $query_slug = !isset(get_category($query_cid)->errors) ? get_category($query_cid)->slug : get_category(1)->slug;
                            echo '<a href="'.get_category_link($query_cid).'" rel="nofollow"><b>'.strtoupper($query_slug).'</b></a>';
                        ?>
                    </div>
                </span>
            </div>
        <?php
            }
            $acg_sw = get_option('site_acgnside_switcher');
            $tag_sw = get_option('site_tagcloud_switcher');
            if($acg_sw||$tag_sw){
        ?>
            <div id="tech-acg-inside_acg" class="wow fadeInUp" data-wow-delay="0.1s">
                <!-- 左图 ，右文窗-->
                <div id="tech-acg-inside_acg-allpart">
                    <div class="newsBox-supTitle flexboxes" id="acg_window-top">
                        <span class="newsBox-supTitle-iDescription" id="icon-acg">
                            <em><?php echo $acg_sw ? 'ACG' : 'TAG'; ?></em><i class="icom icon-acg"></i>
                        </span>
                        <h2> ACG はすぐに TAG </h2><!-- ACG · TAG -->
                    </div>
                    <ul class="acg_window-content">
                    <?php
                        if($acg_sw){
                    ?>
                        <li class="acg_window-content-inside_left"<?php if(!$tag_sw) echo ' style="width: 98%;margin: 15px auto;"'; ?>>
                        	<span id="acg_window-content-inside_left-tInfo">
                    		    <?php $query_cid = get_option('site_acgnside_cid'); ?>
                        		<span id="acg_window-content-inside_left-txt">
                    				<!--<h2>pixivトップ50</h2><a href="javascript:;"> 漫游影视近期动态 </a>-->
                    				<p>pixivで最もホットな2Dクリエイティブドローイングコレクショントップ<span id="acg_window-content-inside_left-txt_hidden" unselectable="on"> 10 </span> &nbsp;以上.</p>
                        		</span>
                        	</span>
                        	<span id="acg_window-content-inside_left-bList">
                        		<ol class="acg_window-content-inside_left-list">
                                    <?php
                                        $query_slug = !isset(get_category($query_cid)->errors) ? get_category($query_cid)->slug : get_category(1)->slug;
                                        if($baas&&strpos(get_option('site_leancloud_category'), 'category-acg.php')!==false){
                                    ?>
                                            <script>
                                                new AV.Query("<?php echo 'acg' ?>").addDescending("updatedAt")  // .equalTo('type_acg', 'anime')  // 当 query_slug 为 acg 时使用
                                                .limit(<?php echo get_option('site_per_posts', get_option('posts_per_page')); ?>).find().then(result=>{
                                                    for (let i=0; i<result.length;i++) {
                                                        let res = result[i],
                                                            type = res.attributes.type_acg,
                                                            title = res.attributes.title,
                                                            subtitle = res.attributes.subtitle,
                                                            updated = res.updatedAt;
                                                        document.querySelector(".acg_window-content-inside_left-list").innerHTML += `<li title="${title}"><a href="/<?php $par_cid = get_category($query_cid)->parent;echo $par_cid!=0&&get_category($par_cid)->slug!='/' ? get_category($par_cid)->slug : get_category($query_cid)->slug; ?>#${type}" target="_blank" rel="nofollow">${subtitle} - （${title}）<sup>${updated}</sup></a></i>`;
                                                    };
                                                })
                                            </script>
                                    <?php
                                        }else{
                                            recent_posts_query($query_cid, false, true, false);
                                        }
                                    ?>
                        		</ol>
                        	</span>
                        </li>
                    <?php
                        }else{
                            echo '<style>.acg_window-content li.acg_window-content-inside_right{display:block}.acg_window-content-inside_right .tags{font-family: math, cursive,monospace,serif,fangsong;padding: 0 15px;margin-top: 15px;}</style>';
                        }
                        if($tag_sw){
                    ?>
                        <li class="acg_window-content-inside_right"<?php if(!$acg_sw) echo ' style="width: 100%;position: relative;"'; ?>>
                            <div class="tags">
                                <?php the_tag_clouds('span'); ?>
                            </div>
                        </li>
                    <?php
                        }
                    ?>
                    </ul>
                    <?php echo $acg_sw ? '<div class="newsBox-subText-Description" id="acg_window-bottom"><a href="'.get_category_link($query_cid).'" rel="nofollow"><b>'.strtoupper($query_slug).'</b></a></div>' : ''; //<a href="javascript:;"><b>TAGCLOUDS</b></a> ?>
                    <!--<div class="newsBox-subText-Description" id="acg_window-bottom">-->
                    <!--    <?php //echo $acg_sw ? '<a href="'.get_category_link($query_cid).'" rel="nofollow"><b>'.strtoupper($query_slug).'</b></a>' : '<a href="javascript:;"><b>CLOUDS</b></a>'; ?>-->
                    <!--</div>-->
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</div>
<footer>
    <?php get_footer(); ?>
</footer>
<?php if(get_option('site_chat_switcher')) echo '<script src="'.get_option('site_chat').'"></script>'; ?>
<?php require_once(TEMPLATEPATH. '/foot.php'); ?>
<script type="text/javascript" src="<?php echo $src_cdn; ?>/js/banner.js?v=<?php echo get_theme_info('Version'); ?>"></script>
<!--<script type="text/javascript" src="<?php echo $src_cdn; ?>/js/cursor.js"></script>-->
</body></html>