# 2BLOG
A Simplized Wordpress Blog Theme Design &amp; Developed from [2broear.com](http://blog.2broear.com) by 2BROEAR Released &amp; openSourced in 2022.

__Preview Site__ ：[演示站点](http://2blog.2broear.com)

![2blog_wordpress_theme](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshot.png "theme overview")

## 主题简介
历经半年之久，__鸽鸽碰碰的 Wordpress 主题 2BLOG 他来了！__ 折腾这么些日子终于算是可以开测了，这里将作为主题开源后续的发布、更新、备份地址。目前主题尚处测试阶段，未上传至 Wordpress。
主题在前静态主题的基础之上做了部分修改及更新，其中主要更新内容包括：

- 页面/首页文章置顶
- 多级富文本、元数据导航
- 自定义 _RSS、SITEMAP_ 内容
- 自定义搜索内容、列表样式
- 新增漫游影视及资源下载页面子级
- 部分页面支持 _wordpress 与 leancloud_ 数据切换
- 重写前端逻辑，移除主要 _jquery_ 依赖

当然了，最重要的还是集成了 __Leancloud 与 Wordpress 之间的数据切换__ ，这个主要是因为之前静态博客使用的是 _valine_ 评论系统（其实之前很少使用 _leancloud_ 数据储存），后面我自己改了很多东西（至于要不要集成到 wp 上只能日后再说了），所以在 _wordpress_ 中仍做了数据切换，然后顺带更新了之前尚未同步数据到 _leancloud_ 的页面。

> 在wordpress中除“公告”外所有数据均以文章形式发布，通过后端函数调用数据，而使用leancloud数据的页面将通过 __`lbms`__ 后台进行数据上传、修改及删除等操作，再通前端过`xhr`异步调用json数据写入。

# 主题文档
主题是职业之余开发完成的，其中的部分页面及功能并不适用于所有人（老早之前还鸽了 _HEXO_ 的主题开发，主要是那个文档有点难找），另外做成 _cms_ 的主要是因为之前静态博客内容多了之后不好管理（再后来甚至做了个 _markdown_ 的编辑器，不过没用就是了），开源呢一方面是因为之前受到了部分博友的认可，有意向使用这个主题，另一方面正巧公司的框架去年也搬到 _wp_ 了所以整个开发流程是相对顺利，写的功能在主题之间都能互通这一点是很友好的。 __以下分为`wp`及`lbms`两方面来讲__

## Wordpress 后台

wordpress 后台设置分为  __基本信息__ 、 __通用控制__ 、 __页面设置__ 、 __侧栏设置__ 、 __页尾控制__  5 个版面，每个版面对应不同的设置选项，_每个选项下方都有相应的功能使用说明，一般情况下只需要对应其提示操作即可。_（其他操作说明将在下个文档版本中补充，如分类、页面、文章中的设置细节等等）

![2blog_theme_setting](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshot/basic.png "2blog basiclly set")

1. ___基本信息___ 只中有 5 个选项，可以修改个人昵称（注意非博客名称）、头像及卡片背景图，包括全站的描述及关键词（单页分类的关键词及各项配置需在 __文章->分类__ 中单独配置）

2. ___通用控制___ 中所拥有控制选项是整个主题最多也是最复杂的，主要包含 __主题颜色__ 、 __LOGO__ 、 __公告__ 、 __元导航__ 、 __面包屑导航__ 、 __Gravatar头像__ 、 __sitemap__ 、 __rss feed__ 、 __搜索结果/样式__ 、 __暗黑模式__ 、 __Leancloud 数据存储__ 、 __第三方 valine 评论__ 、 __评论邮件/微信提醒__ 、 __站点静态文件CDN__ 等等，注意所有涉及邮件收发的选项均需填写 __SMTP 发件服务配置__ 并测试成功之后才能正常使用。

      > 启用 leancloud 设置需要到 leancloud.cn 控制台 __创建应用__ ，然后在 __设置->域名绑定__ 中设置 __API 访问域名__ （二级域名国内需要备案），之后再将博客域名添加到 __设置->安全中心__ 的 __Web 安全域名__ 中，之后在数据储存中创建名称为 __*分类模板名称__ （如 __`category-news.php`__ 模板名称为 __`news`__ ）的 Class 后即可在 wp 后台将已创建的 `appid/appkey/serverurl`（二级域名）填入保存即可。
      > 
      > __第三方评论  Valine__ 的配置流程大同小异，可参考资料：[Valine 快速开始](https://valine.js.org/quickstart.html)
      >
      > 开启 __评论微信提醒__ 功能后需要 __注册企业微信__ 登录完善信息后在 __应用管理->自建__ 中 __创建应用__ ，创建应用完成后，在 __我的企业__ 选项卡中获取 __`企业ID`__ ，之后在 __应用管理->自建__ 中找到刚刚创建的应用，点进去可找到 __`AgentId`__ 和 __`Secret`__ 。
      > 
      > 企业应用配置完成，将 `企业id`、`AgentId`、`Secret` 填入后台对应值即可。注意：开启后需使用微信扫描企业微信中 __我的企业->微信插件__ 栏目中的 __邀请关注__ 栏目二维码后才能收到通知！此外，在 __微信推送消息类型__ 选项中，  _模板卡片_  仅能在 企业微信app 中收到消息推送__ ，微信端暂不支持接收该消息类型。

3. ___页面设置___ 选项，此选项卡内有很多项都是 __下拉选项__ 形式的控制组件，用于选择展示在各页面、位置、类型的已创建的分类选项（目前仅支持一级分类），其余的则是各页面展示 __背景图、背景视频、banner__ 等控件，___所有操作仅需跟随选项下方提示操作即可。___

4. ___侧栏设置___ 选项，此选项卡所有应用仅应用于 __文章资讯__ 页面的右侧，支持 __Google Adsense__ 广告块，默认开启来自 mokeyjay 超能小紫的 __Pixiv每日排行榜小挂件__ ，及自定义展示 __热门文章__ 分类下拉控制。

5. ___页尾控制___ 选项，页面底部有一些文章、评论及联系方式的展示设置，还包括各支持图标展示设置及站外（沟通）插件控制，左侧主要有 __近期文章 和 近期评论__ 选项卡，_所有选项均按选项下方提示操作即可。_ 

&nbsp;

## LBMS 后台

lbms 后台页面将在开启 lbms 选项后自动创建 `lbms` 及 `lbms-login` 两个页面，之后在 leancloud 创建应用之后，可在 `bms-login` 登录创建账号（若注册账号邮件验证不及时，请前往 leancloud 后台对应应用中的 __数据储存->结构化数据->User__ 表中手动设置账号的 __`emailVerified`__ 为 __`true`__ 即可正常登录）

> “ __`news`__ ”选项卡虽已不再使用，但其中的 _markdown_功能仍可以正常使用且支持同步预览。

![2blog_lbms_ui](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshot/lbms.png "lbms UI")

- __weblog__ 

    对应主题模板中的 __`category-weblog.php`__ 日记日志模板，需创建 __`weblog`__ Class

-  __acg__ 

    对应主题模板中的 __`category-acg.php`__ 慢游影视模板，需创建 __`acg`__ Class

-  __link__ 

    对应主题模板中的 __`category-2bfriends.php`__ 友情链接模板，需创建 ___`link`___ Class（ __注意此项使用 link__ ）

-  ~~download~~

    此栏目已废弃，默认使用 _wordpress_ 原生数据

-  __inform__ 

    对应主题模板中的 __`category-weblog.php`__ 公告模板，需创建 __`inform`__ Class

## 其他事项
### 伪静态与固定链接
如需实现 [演示站](http://2blog.2broear.com) 的 _permalink/url_ 层级，需配置如下两项：

___Nginx 伪静态规则___ （apache或其他环境请自行转换语法，宝塔面板可一键配置）
``` nginx
location / {
    try_files $uri $uri/ /index.php?$args;
}
rewrite /wp-admin$ $scheme://$host$uri/ permanent;
```

___Wordpress 固定链接___ （请勿关闭 __通用控制__ 中的 ___移除 CATEGORY___ 选项）
``` plaintext
/%category%/%postname%_%post_id%  
```
固定连接可删除 `%post_id%`，但需要保留 `%post_name%` 后的下划线 “__” __如下图所示__（其目的是为了访问多层级分类时正确显示 url 地址栏中的分类/页面层级，属于临时方案）

![2blog_wordpress_theme](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshot/permalink.png "permalink setting")

&nbsp;

### 主题差异化问题
这款主题和官方在模板设计上有些许不同，通过 _wp_ 默认主题模板文件不难看出一款 _wordpress_ 主题在导航上是通过页面来进行导航的。但是，我之前一直都是用的分类进行页面导航，使用分类页面无法调用评论而百思不得其解的时候到处瞎逛论坛的时候才发现 __wp 根本不支持通过分类调用评论，__ 这也就是说之前写的那套定制导航的逻辑全都不能用，因为主题 __部分页面在调用页面数据的同时需要调用页面评论__ ，这个就很尴尬了，而且通过分类来导航很难控制页面层级关系，再三犹豫期间又跑去写了一个“页面”导航，结果差强人意， __最后还是选择了使用分类作为页面导航__ ，同时在解决调用页面评论这方面的方案则是分类 __固定链接的 url 重写__ ，该方案在伪静态下工作的很好。

不过还要解决之前静态主题的一个层级问题，需要部分分类别名为“`/`”实现略过父级访问子级链接，那么这个 _wordpress_ 不支持这个操作，所以只能通过 `$wpdb` 来强制写入 __（这里就涉及了分类与页面直接的操作数据互相同步）__ ，好在问题目前是得以解决，然而这一连串的问题如果通过页面来做导航就完全不存在了。
