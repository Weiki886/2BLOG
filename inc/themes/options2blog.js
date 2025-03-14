jQuery(document).ready(function($){
    function bindEventClick(parent, ids, callback) {
        if (!parent) {
            console.warn('bindEventClick failed', parent);
            return;
        }
        parent.onclick=(e)=>{
            e = e || window.event;
            let t = e.target || e.srcElement;
            if(!t) return;
            while(t!=parent){
                if(!ids || ids==="") {
                    callback(t,e);
                    break;
                }
                if(t.id===ids || t.classList && t.classList.contains(ids) || t.nodeName.toUpperCase()===ids.toUpperCase()){
                    // callback?.();
                    if(callback&&typeof callback==='function') callback(t,e); //callback(t) || callback(t); // callback.apply(this, ...arguments);
                    break;
                }
                // console.log('origin', t);
                t = t.parentNode;
            }
        };
    }
    
    function getParentElement(curEl, parCls){
      //!curEl.classList incase if dnode oes not have any classes (null occured)
      while(!curEl || !curEl.classList || !curEl.classList.contains(parCls)){
          if(!curEl) break;  //return undefined
          curEl = curEl.parentNode; //parentElement
      };
      return curEl;
    }
    function getParentNode(curPar,tarPar){
        while(curPar && curPar.nodeName.toLowerCase()!=tarPar){
            curPar = curPar.parentNode
        };
        return curPar
    }
    var mediaUploader;
    // var _this;  // preset global this
    const upload_buttons = document.querySelectorAll(".upload_button"),
          ubsLen=upload_buttons.length;
    if(ubsLen>0){
        for(let i=0;i<ubsLen;i++){
            upload_buttons[i].onclick=function(e){
                // _this = this;
                this_parent = this.parentNode;
                var p_list = this_parent.querySelector('.upload_preview_list'),
                    d_type = Number(this.dataset.type), //1:images,2:videos,3:all;
                    u_multi = this.dataset.multi;
                // If the media frame already exists, reopen it (this will Cache mediaUploader frame arguments which's not applicable for required. tested: non-second requests without reopen)
                // e.preventDefault();
                // if(mediaUploader) {  // && !u_multi
                //     mediaUploader.open();
                //     return;
                // }
                //https://wordpress.stackexchange.com/questions/264115/show-only-images-and-videos-in-a-wp-media-window
                switch(d_type){
                    case 1:
                        d_type = 'image';
                        break;
                    case 2:
                        d_type = 'video';
                        break;
                    case 3:
                        d_type = ['video','image'];
                        break;
                    default:
                        d_type = ['video','image'];
                        break;
                }
                console.log(`multiple: ${u_multi}, ${d_type} selection available.`);
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: '',
                    button: {
                        text: '选择文件'
                    },
                    multiple: u_multi ? true : false,
                    library: {
                        type: d_type
                    },
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON(),
                        attachments = mediaUploader.state().get('selection').toJSON();
                    // console.log(mediaUploader.state());
                    let field = this_parent.querySelector('.upload_field'),//.parent().find('.upload_field')[0],
                        img = this_parent.querySelector('.upload_preview.img'),//.parent().find('.upload_preview.img'),
                        bg = this_parent.querySelector('.upload_preview.bg'),//.parent().find('.upload_preview.bg');
                        bgm = this_parent.querySelector('.upload_preview.bgm');
                    // preview loads
                    if(bgm){
                        bgm.setAttribute('src',attachment.url);
                        bgm.setAttribute('poster',attachment.url);
                    }else{
                        img ? img.setAttribute('src',attachment.url) : false;
                        bg ? bg.setAttribute('style','background:url('+attachment.url+') center center /cover;') : false;
                    };
                    if(p_list){
                        p_list.innerHTML = "";
                        field.value = "";
                        for(let i=0,atcLen=attachments.length;i<atcLen;i++){
                            let each_url = attachments[i].url;
                            if(each_url){
                                p_list.innerHTML += '<em class="upload_previews" style="background:url('+each_url+') center center /cover;"></em>';
                                field.value += each_url+' , ';
                            }
                        }
                    }else{
                        field.value = attachment.url;
                    }
                });
                mediaUploader.open();
            };
        }
    }


// ***  ROW JAVASCRIPT FUNCTIONs (AFTER DOCUMENT LOADED) *** //

    const //switch_tab = document.querySelector(".switchTab"),
          switch_form = document.querySelector("form"),
          blog_settings = document.querySelector(".wrap.settings"),
          theme_root = document.querySelector(":root"),
          theme_picker = document.querySelector("input[type=color]");
    if(blog_settings) {
        theme_picker.onchange = theme_picker.oninput=function(){  //onchange/onpropertychange only active when off-focus
            theme_root.style.setProperty("--panel-theme", this.value);
        };
        // 多选框同步逻辑
        const checkboxes = document.querySelectorAll('.checkbox');
        for(let i=0,ckbLen=checkboxes.length;i<ckbLen;i++){
            let eachbox = checkboxes[i],
                eachcheck = eachbox.querySelectorAll('input[type=checkbox]'),
                outputText = eachbox.parentNode.querySelector('input[type=text]');
            for(let j=0,echkLen=eachcheck.length;j<echkLen;j++){
                // let checkArray = [outputText.value];
                let outputTrim = outputText.value.replace(/\s*/g,""),  // clear all whitespace
                    outputEnds = outputTrim.substr(outputTrim.length-1, outputTrim.length);  // last chr
                outputEnds!=','&&outputTrim.length>0 ? outputText.value += ',' : false;  // support IE
                // !outputText.value.replace(/\s*/g,"").endsWith(',')&&outputText.value.length>0 ? outputText.value += ',' : false;  // check if endsWith ',' (not compatible ie)
                eachcheck[j].onchange=function(){
                    // checkArray.push(this.value+' , ');  console.log(checkArray);
                    let clearOutput = outputText.value.replace(/\s*/g,""),  // clear all whitespace
                        clearString = clearOutput.match(this.value+',') ? this.value+',' : this.value;
                    this.checked ? clearOutput += this.value+',' : clearOutput = clearOutput.replace(clearString, '');  // ',' replace logic
                    outputText.value = clearOutput;  // final output
                };
            }
        }
        // 即时更新 select 图片
        const select_images = document.querySelectorAll(".select_images"),
              select_mirror = document.querySelectorAll(".select_mirror");
        for(let i=0,selImgLen=select_images.length;i<selImgLen;i++){
            select_images[i].onchange=function(e){
                let preview = this.options[this.selectedIndex].getAttribute("preview");
                this.parentNode.querySelector("img").src = preview ? preview : this.value;
            };
        }
        for(let i=0,selMirLen=select_mirror.length;i<selMirLen;i++){
            select_mirror[i].onchange=function(e){
                let image = this.parentNode.querySelector("img"),
                    value = this.getAttribute("parm");
                image.src = "";  // clear last-mirror cache https://img.2broear.com/images/loading_3.png
                image.src = value ? this.value+value : this.value;
            };
        }
        
        // 即时更新 select 选项
        const select_options = document.querySelectorAll(".select_options"),
              dynamic_comment = document.querySelector(".dynamic_comment"),
            //   dynamic_opts = document.querySelectorAll(".dynamic_opts"),
            //   dynamic_fn = function(t,c,e){
            //       for(let i=0,tLen=t.length;i<tLen;i++){
            //           t[i].classList.remove(c);
            //       }
            //       if(e && e!=''){
            //           dynamic_comment ? dynamic_comment.innerHTML = e : false;
            //           let dynamic_all = document.querySelectorAll('tr.'+e);
            //           for(let j=0,dynLen=dynamic_all.length;j<dynLen;j++){
            //               dynamic_all[j].classList.add(c);
            //           }
            //       }else{
            //           dynamic_comment ? dynamic_comment.innerHTML = 'BaaS' : false;
            //       }
            //   },
              dynamic_class = 'dynamic_optshow';
              
        for(let i=0,selOptLen=select_options.length;i<selOptLen;i++){
            select_options[i].onchange=function(e){
                let tar = getParentNode(this, 'tr');
                if(tar.classList && !tar.classList.contains('child_option')){
                    let opt = tar.nextElementSibling;
                    while(opt){
                        if(!opt.classList || !opt.classList.contains('child_option')) break;  //跳出循环
                            opt.classList.remove(dynamic_class);  // remove all optshow
                            let optsval = this.value;
                            if(optsval && optsval!=''){
                                dynamic_comment ? dynamic_comment.innerHTML = optsval : false;
                                let dynamic_lock = document.querySelectorAll('tr.'+optsval);
                                for(let j=0,dynLockLen=dynamic_lock.length;j<dynLockLen;j++){
                                    dynamic_lock[j].classList.add(dynamic_class);
                                }
                            }else{
                                dynamic_comment ? dynamic_comment.innerHTML = 'BaaS' : false;
                            }
                            // dynamic_fn(optshow, dynamic_class, optsval);
                            opt = opt.nextElementSibling;  // 继续查找，直到当前元素不含 child_option 类（即非该 checkbox 子项）
                    }
                }
            };
        }
        
        // 自动同步 checkbox 勾选框关联元素（被选框非 child_option，仅一级选框可用）
        const check_boxes = document.querySelectorAll("label input[type=checkbox]");  // inside label only;
        for(let i=0,chkBoxLen=check_boxes.length;i<chkBoxLen;i++){
            check_boxes[i].onchange=function(){
                let tar = getParentNode(this, 'tr');
                if(tar.classList && !tar.classList.contains('child_option')){
                    let opt = tar.nextElementSibling;
                    while(opt){
                        if(!opt.classList || !opt.classList.contains('child_option')) break;  //跳出循环
                            if(this.checked){
                                if(!opt.classList.contains(dynamic_class)) opt.classList.add(dynamic_class);
                            }else{
                                opt.classList.remove(dynamic_class);
                            }
                            opt = opt.nextElementSibling;  // 继续查找，直到当前元素不含 child_option 类（即非该 checkbox 子项）
                            // console.log(tar); //当前元素后一个
                    }
                }
            }
        }
        
        
        // send email to client
        $('.sendmail').on('click',function(){
            $("#loading").removeClass();
            $("#loading").addClass("responsing");
            var data = {
                action: 'mail_before_submit',
                toemail: $('#site_smtp_mail').val(), // change this to the email field on your form
                _ajax_nonce: $('#my_email_ajax_nonce').data('nonce'),
            };
            jQuery.post(window.location.origin + "/wp-admin/admin-ajax.php", data, function(response){
                if(response.match("测试邮件已发送")){
                    $("#loading").addClass("responsed ok");
                }else{
                    $("#loading").addClass("responsed err");
                }
                setTimeout(function() {
                    alert(response);
                    $("#loading").removeClass("responsing");
                }, 500);
            });
        });
        
        // scroll function
        const submit_btn = document.querySelectorAll("p.submit")[0];
        var scroll_throttler = null,
            scroll_record = 0,
            scroll_delay = 200,
            scroll_func = function(e){
                const switch_offset = switch_form.offsetTop;
                return (function(){
                    if(scroll_throttler==null){
                        scroll_throttler = setTimeout(function(){
                            console.log('scroll_throttler');
                            var windowHeight = window.innerHeight,
                                clientHeight = document.body.clientHeight,
                                scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                            scroll_foward = window.pageYOffset;  //scroll Value
                            if(scroll_record-scroll_foward<0){  //down
                                if(scrollTop>=switch_offset){
                                    blog_settings.classList.add("fixed");
                                }
                            }else{  //up
                                if(scrollTop<=switch_offset){ //*4
                                    blog_settings.classList.remove("fixed");
                                }
                            }
                            scroll_record = scroll_foward;  // Update scrolled value
                            scroll_throttler = null;  //消除定时器
                        }, scroll_delay);
                    }
                })();
            };
        if (switch_form) window.addEventListener('scroll', scroll_func, true);
        
        // same options sync(identify by input id)
        const sync_data = [
            'site_leancloud_appid',
            'site_leancloud_appkey',
            'site_leancloud_server',
        ];
        for(let i=0,syncLen=sync_data.length;i<syncLen;i++){
            let each_list = document.querySelectorAll("input#"+sync_data[i]);
            for(let j=0,listLen=each_list.length;j<listLen;j++){
                each_list[j].oninput=function(e){
                    let each_data = document.querySelectorAll("input#"+this.id);
                    for(let k=0,dataLen=each_data.length;k<dataLen;k++){
                        each_data[k].value = this.value;  //cur_data.classList.add("sync");
                    }
                };
            }
        }
    }
    
    // switch tabs & active class
    const activecls = "active",
          switchcls = "show",
          switchtab = document.querySelectorAll(".switchTab li"),
          clearClass = function(els,cls){
              for(let i=0,elsLen=els.length;i<elsLen;i++){
                  els[i].classList.remove(cls);
              }
          },
          formtable = document.querySelectorAll("form .formtable")[0],
          pushParam = function(key,value){
              // THIS FUNCTION CONSTRUCTED VIA chatGPT 3.5 MODEL.
              const href = window.location.href;
              var newUrl = href;
              if(window.URLSearchParams){
                  const params = new URLSearchParams(window.location.search);  // Get the current URLSearchParams object
                  params.set(key, value);  // Update the value of a parameter
                  newUrl = `${window.location.pathname}?${params.toString()}`;  // Create a new URL with the updated parameters
              }else{
                  const url = new URL(href);  // Get the current URL as a URL object
                  url.searchParams.delete(key);  // Remove a parameter from the query string
                  url.searchParams.set(key, value);  // Add or update a parameter in the query string
                  newUrl = url.toString();  // Get the updated URL string
              }
              history.pushState(null, '', newUrl);  // Update the URL without refreshing the page
          },
          getQueryObject = function(url) {
              url = url == null ? window.location.href : url;
              var search = url.substring(url.lastIndexOf("?") + 1);
              var obj = {};
              var reg = /([^?&=]+)=([^?&=]*)/g;
              search.replace(reg, function (rs, $1, $2) {
                  var name = decodeURIComponent($1);
                  var val = decodeURIComponent($2);
                  val = String(val);
                  obj[name] = val;
                  return rs;
              });
              return obj;
          },
          parms = getQueryObject();
          
    // console.log(switchtab);
    if(parms && parms.tab) {
        document.querySelector("form ."+parms.tab).classList.add(switchcls);
        document.querySelector(".switchTab li#"+parms.tab).classList.add(activecls);  // clearClass then active
    } else {
        formtable ? formtable.classList.add(switchcls) : formtable;  // auto active first formtable
        if (switchtab[0]) switchtab[0].classList.add(activecls);  // clearClass then active
    }
    
    bindEventClick(document.querySelector(".switchTab"), 'li', (t)=> {
        pushParam('tab', t.id);
        // location.search = '?page=2blog-settings&tab='+t.id;
        clearClass(switchtab, activecls);  // clear actived class
        t.classList.add(activecls);  // clearClass then active
        clearClass(document.querySelectorAll("form ."+switchcls),switchcls);  // upadted els while click
        document.querySelector("form ."+t.id).classList.add(switchcls);  // clearClass then show
    });
    
    bindEventClick(document, '', (t)=> {
        if (t.id!=='updateSchedule') return;
        // console.log(t)
        if (confirm(`Updating Scheduled Tasks(scheduled_rss_feeds_updates)?`)) {
            const updateScheduleInput = document.querySelector('#updateSchedules');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', t.dataset.adminUrl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        t.disabled = true;
                        alert('updating status: ' + response.data + ' Standby cronjob-redepoly..'); // + ', Locate to rss-feeds now..'
                        let counter = 3;
                        t.value = 'Standby ' + counter;
                        let countdown = setInterval(()=> {
                            if (counter<=1) {
                                clearInterval(countdown);
                                t.value = 'Schedules updated';
                                updateScheduleInput.disabled = false;
                                updateScheduleInput.focus();
                                return;
                            }
                            counter--;
                            t.value = 'Standby ' + counter;
                        }, 1000);
                        // location.replace(location.origin + location.pathname + "?page=" + t.dataset.page);
                        // location.reload(true);
                    } else {
                        console.error('Error:', response.data);
                    }
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            };
            xhr.send('action=update_cronjobs&nonce=' + t.dataset.nonce + '&interval=' + updateScheduleInput.value);
            // fetch(`${t.dataset.api}refresh=1`, {
            //     method: 'GET',
            // })
            // .then(res=> {
            //     if (res.ok) {
            //         return res.text(); //json()
            //     }
            //     console.warn('request failed.')
            // })
            // .then(data=> {
            //     t.disabled = 'disabled';
            //     alert(data + ', Locate to rss-feeds now..');
            //     location.replace(location.origin + location.pathname + "?page=" + t.dataset.page);
            //     // location.reload(true);
            // })
            // .catch(error => {
            //     container.querySelector('p').innerHTML = `Reload site_rss_${dataset.cat}_cache failed, <u>${ error }!</u>`;
            //     console.error('Error fetching progress:', error);
            // });
        }
    });
    
    
    // rss fetch feeds reloader
    const contents = document.querySelector('#contents');
    const reloader = 'reloadFeeds';
    if (contents) {
        // const reloadFeeds = contents.querySelector('.reloadFeeds');
        bindEventClick(contents, '', (t)=> { //reloader
            if (t.id==='reloadCount') {
                const reloadFeeds = t.parentNode.querySelector('.reloadFeeds');
                t.onchange = t.onpropertychange = ()=> reloadFeeds.dataset.limit = t.value;
                return;
            }
            if (t.classList && t.classList.contains(reloader)) {
                const dataset = t.dataset;
                const container = contents.querySelector(`.formtable.${dataset.cat}.${switchcls}`);
                if (!confirm(`重新拉取 ${dataset.cat} 中所有 rss 数据（${dataset.limit}条）？`)) return;
                t.textContent = `fetching ${dataset.cat}...`;
                t.classList.remove(reloader);
                console.log('loading url: ', dataset.api);
                fetch(`${dataset.api}&cat=${dataset.cat}&limit=${dataset.limit}&update=${dataset.update}&output=${dataset.output}&clear=${dataset.clear}`, {
                    method: 'GET',
                })
                .then(res=> {
                    if (res.ok) {
                        console.log('data loaded.', res);
                        return res.text(); //json()
                    }
                    console.warn('request failed.')
                    // const reader = res.body.getReader();
                    // let receivedLength = 0; // 已接收的数据长度
                    
                    // reader.read().then(function processText({ done, value }) {
                    //     if (done) {
                    //         console.log('Stream complete');
                    //         return;
                    //     }
                    //     receivedLength += value.length;
                    //     const totalLength = res.headers.get('Content-Length');
                    //     const progress = Math.round((receivedLength / totalLength) * 100);
                        
                    //     console.log(progress + '%');
                        
                    //     return reader.read().then(processText);
                    // });
                })
                .then(data=> {
                    container.innerHTML = `<p style="text-align:right">site_rss_${dataset.cat}_cache Reloaded, <u>${dataset.cat} reloaded!</u></p> ${ data }`;
                    console.log('data fullfilled.');
                    alert(`${dataset.cat} rss data loaded.`);
                })
                .catch(error => {
                    container.querySelector('p').innerHTML = `Reload site_rss_${dataset.cat}_cache failed, <u>${ error }!</u>`;
                    console.error('Error fetching progress:', error);
                });
                return;
            }
        });
    }
});
