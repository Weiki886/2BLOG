<?php    global $img_cdn;    // 倒计时挂件    function the_countdown_widget($date=false, $title=false, $bgimg=false){        if(get_option('site_countdown_switcher')){            $date = $date ? $date : get_option('site_countdown_date');            $title = $title ? $title : get_option('site_countdown_title');            $bgimg = $bgimg ? $bgimg : replace_video_url(get_option('site_countdown_bgimg'), 'sidebar');            $countDate = date('Y/m/d,H:i:s',strtotime($date));            $countTitle = explode('/', $title);    ?>            <style>.news-ppt div,#countdown:before{border-radius:inherit}.countdown-box{width:100%;height:100%;min-height:160px;position:relative;}/* 新年侧边栏 */ #countdown {height:100%;padding: 1rem;box-sizing: border-box;position: absolute;top: 0;left: 0;width: 100%;background-size: cover;background-position: center;border-radius:var(--radius)}#countdown * {position: relative;color: white!important;/*line-height: 1.2;*/}#countdown p,#countdown div{position:relative;z-index:9;}#countdown p{text-align: left;margin: auto;font-size: small;}#countdown p.title{font-weight:bold;}#countdown p.today{opacity: .75;font-size: 12px;position: inherit;bottom: 15px;right: 15px;}#countdown .time {font-weight: bold;text-align: center;width:100%;position: inherit;top: 50%;left: 50%;transform: translate(-50%,-50%);}#countdown .time, #countdown .timesup {font-size: 3.5rem;display: block;/*margin: 1rem 0;*/}#countdown .day {font-size: 4rem;}@keyframes typing{0%{opacity:0;}50%{opacity:1;}100%{opacity:0;}}#countdown .day .unit {font-size: 1rem;display:inline;animation: typing ease .8s infinite;-webkit-animation: typing ease .8s infinite;opacity:0;}#countdown:before{content: "";position: inherit;left: 0;top: 0;height: 100%;width: 100%;background-color: rgba(0, 0, 0, .36);z-index:1;}.countdown-box video{width: 100%;height: 100%;position: absolute!important;top: 0;left: 0;object-fit: cover;border-radius:inherit;}</style>            <div class="countdown-box" style="margin-bottom: 15px">                <div id="countdown" style="background-image:url(<?php //echo $bgimg; ?>)">                    <video src="<?php echo $bgimg; ?>" poster="<?php echo $bgimg; ?>" preload="" autoplay="" muted="muted" loop="" x5-video-player-type="h5" controlslist="nofullscreen nodownload"></video>                    <p class="title"><?php echo $countTitle[0]; ?></p>                    <div class="time"></div>                    <p class="today"></p>                </div>            </div>            <script>                const main = document.querySelector('#countdown'),                      target = main.querySelector('.time'),                      title = main.querySelector('.title'),                      today = main.querySelector('.today'),                      weeks = ['日','一','二','三','四','五','六'],                      fillZero = function(i){                          return i < 10 ? "0"+i : i;                      },                      endup = "<?php echo $countTitle[1]; ?>";                var nowtime = new Date(),                    endtime = new Date("<?php echo $countDate; ?>"),                    result = parseInt((endtime.getTime() - nowtime.getTime()) / 1000),                    day = parseInt(result / (24 * 60 * 60));                today.innerHTML = `${nowtime.getMonth()+1}月${nowtime.getDate()}日 &nbsp;星期${weeks[nowtime.getDay()]}`;                if(parseInt(day)<=0 && result>0){                    (function countDown() {                        // console.log('counting..')                        let now = new Date(),                            res = parseInt((endtime.getTime() - now.getTime()) / 1000),                            hour = fillZero(parseInt(res / (60 * 60) % 24)),                            min = fillZero(parseInt(res / 60 % 60)),                            sec = fillZero(parseInt(res % 60)),                            text = hour>0 ? hour+':'+min+':'+sec : (min>0 ? min+':'+sec : sec);                        target.innerHTML = '<span class="day">'+text+'</span>';                        if(res <= 0) {                            title.innerHTML = "TIME'S UP!";                            target.innerHTML = "<span class='timesup'>"+endup+"</span>";                            clearTimeout(countDown);                            countDown = null;                            return;                        }                        setTimeout(countDown, 1000);                    })();                }else{                    target.innerHTML = `<span class="day">${fillZero(day)}<span class="unit">天</span></span>`;                    if(result <= 0) {                        title.innerHTML = "TIME'S UP!";                        target.innerHTML = "<span class='timesup'>"+endup+"</span>";                    }                }            </script><?php        }    }?><style>    .countdowns:before{background-color: rgb(255 255 255 / 12%)!important;}    .countdowns *{color: var(--preset-link);opacity:.75;}    .news-ppt div,#countdown:before{border-radius:inherit}.countdown-box{width:100%;height:100%;min-height:160px;position:relative;}/* 新年侧边栏 */ #countdown {height:100%;padding: 1rem;box-sizing: border-box;position: absolute;top: 0;left: 0;width: 100%;background-size: cover;background-position: center;border-radius:var(--radius)}#countdown * {position: relative;}#countdown p,#countdown div{position:relative;z-index:9;}#countdown p{text-align: left;margin: auto;font-size: small;}#countdown p.title{font-weight:bold;}#countdown p.today{opacity: .75;font-size: 12px;position: inherit;bottom: 15px;right: 15px;}#countdown .time {font-weight: bold;text-align: center;width:100%;position: inherit;top: 50%;left: 50%;transform: translate(-50%,-50%);}#countdown .time, #countdown .timesup {font-size: 3.5rem;display: block;opacity:1;/*margin: 1rem 0;*/}#countdown .day {font-size: 4rem;}@keyframes typing{0%{opacity:0;}50%{opacity:1;}100%{opacity:0;}}#countdown .day .unit {font-size: 1rem;display:inline;animation: typing ease .8s infinite;-webkit-animation: typing ease .8s infinite;opacity:0;}#countdown:before{content: "";position: inherit;left: 0;top: 0;height: 100%;width: 100%;background-color: rgba(0, 0, 0, .36);z-index:1;}.countdown-box video{width: 100%;height: 100%;position: absolute!important;top: 0;left: 0;object-fit: cover;border-radius:inherit;}.countdown-box a:hover #countdown{filter:saturate(1.05) brightness(1.05)}    .countdown-box #ads{position: absolute;top: 0;right: 0;margin: 10px;z-index: 9;border: 1px solid;padding: 0 7px;line-height: 18px;border-radius: 5px;font-size: 12px;opacity: .15;}</style><?php    $sidebar = !array_key_exists('sidebar_status',$_COOKIE) ? 1 : $_COOKIE['sidebar_status'];    if($sidebar){?>        <div class="news-slidebar-window<?php //echo $status ? " fv-switch" : false; ?>">            <style>.news-content-right-download, .news-content-right-recommend,.news-ppt div:first-of-type{margin: auto;}/*.news-ppt div{margin-top: 15px;}*/</style>            <div id="translatez">                <div class="news-ppt">                    <?php                         $countdown_sw = get_option('site_countdown_switcher');                        $pixiv_sw = get_option('site_pixiv_switcher');                        $ads_sw = get_option('site_ads_switcher');                        // if(!$countdown_sw) echo do_shortcode('[sidebar_ads title="" sup="喜欢本站主题？" sub src="https://github.com/2Broear/2BLOG" img="https://img.2broear.com/2022/08/2BLOG-rainbow666.jpg"]');                        if($ads_sw || $countdown_sw || $pixiv_sw){                    ?>                            <?php                                if($ads_sw){                                    echo '<div class="ads">';                                        $ads_temp = '<div class="topic"><span class="topic-inside" id="news"><i class="icom"></i></span><h2> Google Ads</h2></div>'.get_option('site_ads_init');                                        echo is_single() ? (get_option('site_ads_arsw') ? $ads_temp : '<h2 style="opacity:.75">文章页未启用广告！</h2>') : $ads_temp;                                    echo '</div>';                                }                                // 倒计时挂件                                the_countdown_widget();                                // the_countdown_widget('2023/01/15,00:00:00','自定义定时器/时间到','https://img.2broear.com/2022/11/20220317110318864801-1024x533.jpg');                                if($pixiv_sw){                            ?>                                	<div class="news-content-right-recommend wow fadeInUp" data-wow-delay="0.1s" style="margin-bottom: 15px">                                		<div class="topic"><span class="topic-inside"><i class="icom"></i></span>                                			<h2> Pixivトップ <?php $num=get_option('site_bar_pixiv');echo(intval($num)); ?> </h2>                                		</div>                                		<div id="rcmdNewsAside" style="">                                	        <iframe loading="lazy" id="ifm" src="https://cloud.mokeyjay.com/pixiv?limit=<?php echo(intval($num)); ?>" frameborder="0"  style="width:100%; height:100%; display:block;border-radius:inherit" title="pixiv ranks"></iframe>                                		</div>                                	</div>                            <?php                                 }                        }                    ?>                </div>                <div class="news-content-right-window-all">                    <?php                        if(get_option('site_mostview_switcher')){                        ?>                        	<div class="news-content-right-download wow fadeInUp" data-wow-delay="0.1s" style="<?php //echo $auto_marin; ?>">                        		<div class="topic"><span class="topic-inside" id="download"><i class="icom"></i></span>                        			<h2> 热门文章 </h2>                        		</div>                        		<style>#loading{padding:0;}</style>                        		<ol class="dload-list" id="mostview">            		    <?php                        	        if(get_option('site_third_comments')!='Valine'){                                        // https://qastack.cn/wordpress/15477/custom-query-with-orderby-meta-value-of-custom-field                                        $most_view = query_posts(array('cat'=>[get_option('site_mostview_cat')], 'posts_per_page'=>get_option('site_recent_num'), 'orderby'=>'order_clause',                                             'meta_query'=>array(                                               'order_clause' => array(                                                    'key' => 'post_views',                                                    // 'value' => 'some_value',                                                    'type' => 'NUMERIC' // unless the field is not a number                                                )                                            )                                        ));                                        if(count($most_view)>0){                                            while (have_posts()): the_post();                    ?>                                                <li data-view="<?php echo getPostViews(get_the_ID()); ?>" data-comment="<?php echo $post->comment_count; ?>">                                                    <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>                                                </li>                    <?php                                            endwhile;                                            wp_reset_query(); // endwhile;                                        }else{                                            echo '<h2> NO POST RECORD </h2>';                                        }                	                }else{                	                    echo '<span id="loading"></span>';                	                }                    ?>                        		</ol>                        	</div>                	<?php                        }                        // echo do_shortcode('[netease_embed id="898131683" width height]')                    ?>                </div>            </div>        </div><?php    }else{?>        <style>.news-content-window{width:100%}</style><?php    }?>