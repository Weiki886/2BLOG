<?php    $sidebar = array_key_exists('sidebar_status',$_COOKIE) ? $_COOKIE['sidebar_status'] : false;    if($sidebar){?>        <div class="news-slidebar-window<?php //echo $status ? " fv-switch" : false; ?>">            <style>.news-content-right-download, .news-content-right-recommend,.news-ppt div:first-of-type{margin: auto;}.news-ppt div{margin-top: 15px;}</style>            <div id="translatez">                <?php                     $countdown_sw = get_option('site_countdown_switcher');                    $pixiv_sw = get_option('site_pixiv_switcher');                    $ads_sw = get_option('site_ads_switcher');                    // $auto_marin = !$ads_sw&&!$countdown_sw&&!$pixiv_sw ? "margin:auto" : false;                    if($ads_sw || $countdown_sw || $pixiv_sw){                ?>                        <div class="news-ppt"style="margin-bottom:15px">                            <?php                                if($ads_sw){                                    echo '<div class="ads">';                                        $ads_temp = '<div class="topic"><span class="topic-inside" id="news"><i class="icom"></i></span><h2> Google Ads</h2></div>'.get_option('site_ads_init');                                        echo is_single() ? (get_option('site_ads_arsw') ? $ads_temp : '<h2 style="opacity:.75">文章页未启用广告！</h2>') : $ads_temp;                                    echo '</div>';                                }                                // 倒计时挂件                                the_countdown_widget();                                // the_countdown_widget('2023/01/15,00:00:00','自定义定时器/时间到','https://img.2broear.com/2022/11/20220317110318864801-1024x533.jpg');                                if($pixiv_sw){                            ?>                                	<div class="news-content-right-recommend wow fadeInUp" data-wow-delay="0.1s">                                		<div class="topic"><span class="topic-inside"><i class="icom"></i></span>                                			<h2> Pixivトップ <?php $num=get_option('site_bar_pixiv');echo(intval($num)); ?> </h2>                                		</div>                                		<div id="rcmdNewsAside" style="">                                	        <iframe loading="lazy" id="ifm" src="https://cloud.mokeyjay.com/pixiv?limit=<?php echo(intval($num)); ?>" frameborder="0"  style="width:100%; height:100%; display:block;border-radius:inherit" title="pixiv ranks"></iframe>                                		</div>                                	</div>                            <?php                                 }                            ?>                        </div>                <?php                    }                ?>                <div class="news-content-right-window-all">                    <?php                        if(get_option('site_mostview_switcher')){                        ?>                        	<div class="news-content-right-download wow fadeInUp" data-wow-delay="0.1s" style="<?php //echo $auto_marin; ?>">                        		<div class="topic"><span class="topic-inside" id="download"><i class="icom"></i></span>                        			<h2> 热门文章 </h2>                        		</div>                        		<style>#loading{padding:0;}</style>                        		<ol class="dload-list" id="mostview">            		    <?php                        	        if(get_option('site_third_comments')!='Valine'){                                        // https://qastack.cn/wordpress/15477/custom-query-with-orderby-meta-value-of-custom-field                                        $most_view = query_posts(array('cat'=>get_option('site_mostview_cid'), 'posts_per_page'=>get_option('site_recent_num'), 'orderby'=>'order_clause',                                             'meta_query'=>array(                                               'order_clause' => array(                                                    'key' => 'post_views',                                                    // 'value' => 'some_value',                                                    'type' => 'NUMERIC' // unless the field is not a number                                                )                                            )                                        ));                                        if(count($most_view)>0){                                            while (have_posts()): the_post();                    ?>                                                <li data-view="<?php echo getPostViews(get_the_ID()); ?>" data-comment="<?php echo $post->comment_count; ?>">                                                    <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>                                                </li>                    <?php                                            endwhile;                                            wp_reset_query(); // endwhile;                                        }else{                                            echo '<h2> NO POST RECORD </h2>';                                        }                	                }else{                	                    echo '<span id="loading"></span>';                	                }                    ?>                        		</ol>                        	</div>                	<?php                        }                    ?>                </div>            </div>        </div><?php    }else{?>        <style>.news-content-window{width:100%}</style><?php    }?>