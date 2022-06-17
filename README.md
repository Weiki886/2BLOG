2BLOG THEME
====================================================================================================================================================================
A Simplized Wordpress Blog Theme Design &amp; Developed from [2broear.com](http://blog.2broear.com) by 2BROEAR Released &amp; openSourced in 2022.

__Preview Site__ ：[演示站点](http://wpl.2broear.com)

![2blog_wordpress_theme](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshot.png "theme overview")

主题简介
--------------------------------------------------------------------------------------------------------------------------------------------------------------
历经半年之久，__鸽鸽碰碰的 WordPress 主题 2BLOG 他来了！！__ 折腾这么些日子终于算是可以开测了，这里将作为主题开源后续的发布、更新、备份地址。目前主题尚处测试阶段，未上传至 Wordpress。
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

主题结构
--------------------------------------------------------------------------------------------------------------------------------------------------------------
主题是职业之余开发完成的，主要是满足个人需求的同时进行开发，其中的部分功能页面可能不适用于所有人（老早之前还鸽了 _HEXO_ 的主题开发，主要是那个文档有点难找），做成 _cms_ 的主要原因是因为之前静态博客的内容多了之后有点不好管理（后面做了个 _markdown_ 的编辑器来发布文章，不过没用就是了），开源呢一方面是因为之前受到了部分博友的认可，都表示有意向这个主题，另一方面正巧公司的框架去年也搬到 _wp_ 了所以整个开发流程是相对顺利，写的功能在主题之间都能互通这一点是很友好的。 

__以下分为 `wp` 及 `lbms` 两个结构简述__ （其中， __LBMS__ 为测试构架，__无需使用 leancloud 的情况下可以__ ___无视不使用__）

### WordPress 后台

wordpress 后台设置分为  __基本信息__ 、 __通用控制__ 、 __页面设置__ 、 __侧栏设置__ 、 __页尾控制__  5 个版面，每个版面对应不同的设置选项，_每个选项下方都有相应的功能使用说明，一般情况下只需要对应其提示操作即可。_（其他操作说明将在下方 __文档说明__ 中补充，如分类、页面、文章中的设置细节等等）

![2blog_theme_setting](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshots/basic.png "2blog basiclly set")

1. ___基本信息___ 只中有 5 个选项，可以修改个人昵称（注意非博客名称）、头像及卡片背景图，包括全站的描述及关键词（单页分类的关键词及各项配置需在 __文章->分类__ 中单独配置）

2. ___通用控制___ 中所拥有控制选项是整个主题最多也是最复杂的，主要包含 __主题颜色__ 、 __LOGO__ 、 __公告__ 、 __元导航__ 、 __面包屑导航__ 、 __Gravatar头像__ 、 __sitemap__ 、 __rss feed__ 、 __搜索结果/样式__ 、 __暗黑模式__ 、 __Leancloud 数据存储__ 、 __第三方 valine 评论__ 、 __评论邮件/微信提醒__ 、 __站点静态文件CDN__ 等等，注意所有涉及邮件收发的选项均需填写 __SMTP 发件服务配置__ 并测试成功之后才能正常使用。

      > 启用 leancloud 设置需要到 leancloud.cn 控制台 __创建应用__ ，然后在 __设置->域名绑定__ 中设置 __API 访问域名__ （二级域名国内需要备案），之后再将博客域名添加到 __设置->安全中心__ 的 __Web 安全域名__ 中用以开启调用API数据，再之后在 __数据储存->结构化数据__ 中创建名称为 __*wp分类模板名称__ （如 __`category-news.php`__ 模板名称为 __`news`__ ）的 `Class` ，最后将 __设置->应用凭证__ 中的 `appid、appkey、serverurl（rest api）`填入 _wp_ 后台对应选项保存即可。
      > 
      > __Valine__ 配置流程大同小异 [快速开始](https://valine.js.org/quickstart.html)
      > ----------------------
      > 开启 __评论微信提醒__ 功能后需要 __注册企业微信__ 登录完善信息后在 __应用管理->自建__ 中 __创建应用__ ，创建应用完成后，在 __我的企业__ 选项卡中获取 __`企业ID`__ ，之后在 __应用管理->自建__ 中找到刚刚创建的应用，点进去可找到 __`AgentId`__ 和 __`Secret`__ 。
      > 
      > 企业应用配置完成，将 `企业id`、`AgentId`、`Secret` 填入后台对应值即可。注意：开启后需使用微信扫描企业微信中 __我的企业->微信插件__ 栏目中的 __邀请关注__ 栏目二维码后才能收到通知！此外，在 __微信推送消息类型__ 选项中，  _模板卡片_  仅能在 企业微信app 中收到消息推送__ ，微信端暂不支持接收该消息类型。

3. ___页面设置___ 选项，此选项卡内有很多项都是 __下拉选项__ 形式的控制组件，用于选择展示在各页面、位置、类型的已创建的分类选项（目前仅支持一级分类），其余的则是各页面展示 __背景图、背景视频、banner__ 等控件。

4. ___侧栏设置___ 选项，此选项卡所有应用仅应用于 __文章资讯__ 页面的右侧，支持 __Google Adsense__ 广告块，默认开启来自 mokeyjay 超能小紫的 __Pixiv每日排行榜小挂件__ ，及自定义展示 __热门文章__ 分类下拉控制。

5. ___页尾控制___ 选项，页面底部有一些文章、评论及联系方式的展示设置，还包括各支持图标展示设置及站外（沟通）插件控制，左侧主要有 __近期文章 和 近期评论__ 选项卡，_所有选项均按选项下方提示操作即可。_ 

### LBMS 后台

lbms 后台将在 __`通用控制`__ 中的 _leancloud_ 选项开启后自动创建 `lbms` 及 `lbms-login` 页面。在 leancloud 创建应用之后，可通过 _leancloud_ 或 `/bms-login` 页面创建账号（若注册账号邮件验证不及时，请前往 leancloud 后台对应应用中的 __数据储存->结构化数据->User__ 表中手动设置账号的 __`emailVerified`__ 为 __`true`__ 即可正常登录）

-  ~~news~~ 此栏目已废弃，默认原生 _wordpress_ 数据
- __weblog__ 对应主题模板中的 __`category-weblog.php`__ 日记日志模板，需创建 __`weblog`__ Class
-  __acg__ 对应主题模板中的 __`category-acg.php`__ 慢游影视模板，需创建 __`acg`__ Class
-  __link__ 对应主题模板中的 __`category-2bfriends.php`__ 友情链接模板，需创建 ___`link`___ Class（ __注意此项使用 `link`__ ）
-  ~~download~~ 此栏目已废弃，默认原生 _wordpress_ 数据
-  __inform__ 对应主题模板中的 __`category-weblog.php`__ 公告模板，需创建 __`inform`__ Class

> __`news`__ 选项卡虽已不再使用，但其中的 _markdown_ 功能仍可以正常使用且支持同步预览。

![2blog_lbms_ui](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshots/edit.png "lbms UI")

文档说明
====================================================================================================================================================================
### 安装说明
所有步骤和普通 _wordpress_ 主题安装无异（测试环境为最新版的 __WordPress 6.0__ ），主题安装完成后，在 __外观->主题->上传主题->选择.zip压缩包__ 启用即可。

> 主题安装并启用后即可正常访问，不过其中部分数据需要在后台点击 ___2BLOG主题设置___ 后以初始化预设

### 分类导航
在 __文章->分类__ 中的下方有一组名为 __`Page Sync Options`__ 的选项，里面有各分类同步页面的自定义属性： 

- __Background Images__ （分类背景）
- __Page Template__ （分类绑定的页面模板）
- __Page Title__ （分类/页面自定义标题）
- __Page Keywords__ （分类/页面自定义关键词）
- __Page Description__ （分类描述）

其中 ___分类背景___ 用于后台开启 __元分类导航__ 后所应用的背景图， ___页面模板___ 则为创建分类后所同步的页面模板（创建分类后会自动新建相同名称、别名、模板的页面） _这里隐藏了一个  __Category Order__ 选项，也就是 __页面__ 中的 `menu_order` 用于导航排序。在默认创建分类时会自动将其 `term_id` 同步到所创建应页面的 `menu_order`，__在分类创建后单独编辑时可查看和修改其 `Category Order` 导航排序（规则默认值越小越靠前，适用于所有层级，建议不要更改 页面 中的 `menu_order` 选项，以方便查看页面所绑定的同步分类id）__

> __额外属性：__ 当分类别名设置为 __`slash`__ 时，其创建的分类将使用 `/` 作为分类导航别名 __（即无导航，此时访问该导航下的分类时将直接作为其父级的层级显示页面）__ （特殊需求，可无视）

注意，在后台 __通用控制->页面层级关系__ 中可以控制是否同步分类层级到页面层级（这样更方便查看和编辑页面），此选项因其开启后将会导致无法正常使用 ___`slash`___ 关键字的原因所以  __默认关闭，如果没有使用 `slash` 将子级作为父级输出的需求，则可以开启__

![2blog_theme_setting](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshots/category.png "2blog category set")

#### 文章排序
WP自带的 __“置顶这篇文章”__ 将作为 ___置顶到首页___ 使用，一般情况下普通文章使用 `排序（列表）排序值` 进行排序（最后编辑排序值>排序值>发布日期），值越大越靠前。

### 评论设置
WordPress 评论在后台 __设置->讨论__ 中可设置 ___评论数量、分页、嵌套、限制等___

Valine 评论在 `footer.php` 中 __初始化__ 各项原生配置及自定义选项（微信评论通知代码在 valine.js 中检索 `custom_initfield_wxnotify` 即可定位修改）

### 友情链接
在 __链接__ 栏目中，所有选项都是官方默认的，所以只需要注意几个单独的点设置即可。首先，需要设置以下几个特殊变量作为友链的分类依据：
- `standard` __默认友链__（包含头像、名称、描述）
- `special` __特殊友链__（包含名称、描述）
- `sitelink` __全站友链__（包含名称、在所有页面底部显示）
- `missing` __失联友链__（包含名称、在 _特殊友链_ 下方显示，nofollow）

> __额外属性：__ 当链接中的 __评级__ 属性 `>=1` ，则该链接将被标记为 ___`girl`___ （特殊♀标识）

伪静态与固定链接
--------------------------------------------------------------------------------------------------------------------------------------------------------------------
如需实现 [演示站](http://wpl.2broear.com) 的 _permalink/url_ 层级，需配置如下两项：

___Nginx 伪静态规则___ （apache或其他环境请自行转换语法，宝塔面板可一键配置）
``` nginx
location / {
    try_files $uri $uri/ /index.php?$args;
}
rewrite /wp-admin$ $scheme://$host$uri/ permanent;
```

___WordPress 固定链接___ （请勿关闭 __通用控制__ 中的 ___移除 CATEGORY___ 选项）
``` plaintext
/%category%/%postname%_%post_id%  
```
固定连接可删除 `%post_id%`，但需要保留 `%post_name%` 后的下划线 “`_`” __如下图所示__（其目的是为了访问多层级分类时正确显示 url 地址栏中的分类/页面层级，属于临时方案）

![2blog_wordpress_theme](https://raw.githubusercontent.com/2Broear/2BLOG/main/screenshots/permalink.png "permalink setting")

#### 主题差异化问题
这款主题和官方在模板设计上有些许不同，通过 _wp_ 默认主题模板文件不难看出一款 _wordpress_ 主题在导航上是通过页面来进行导航的。但是，我之前一直都是用的分类进行页面导航，使用分类页面无法调用评论而百思不得其解的时候到处瞎逛论坛的时候才发现 __wp 根本不支持通过分类调用评论，__ 这也就是说之前写的那套定制导航的逻辑全都不能用，因为主题 __部分页面在调用页面数据的同时需要调用页面评论__ ，这个就很尴尬了，而且通过分类来导航很难控制页面层级关系，再三犹豫期间又跑去写了一个“页面”导航，结果差强人意， __最后还是选择了使用分类作为页面导航__ ，同时在解决调用页面评论这方面的方案则是分类 __固定链接的 url 重写__ ，该方案在伪静态下工作的很好。

不过还要解决之前静态主题的一个层级问题，需要部分分类别名为“`/`”实现略过父级访问子级链接，那么这个 _wordpress_ 不支持这个操作，所以只能通过 `$wpdb` 来强制写入 __（这里就涉及了分类与页面直接的操作数据互相同步）__ ，好在问题目前是得以解决，然而这一连串的问题如果通过页面来做导航就完全不存在了。

支持 & 其他
====================================================================================================================================================================

### 2BLOG 主题的开发主要有以下支持

感谢以下产品提供的服务，__2BLOG__ 在这些依赖下完成开发。

- WordPress 提供的CMS程序及主题开发文档支持
- Leancloud 提供的 BaaS 数据储存服务
- Valine 提供的无后端评论系统
- Wechat 提供的微信消息推送服务
- ...

### 第三方服务插件列表（前端）

在网站前端中有些属于全站依赖，另外有些仅部分页面调用。

- iconmoon.io（字体图标）
- highlight.js（代码高亮）
- fancybox.js（图集灯箱）
- qrcode.js（二维码生成）
- html2canvas.js（html图片生成）
- marked.js（markdown文档解析）
- md5.js（md5邮件解析）
- nprogress.js（文档进度条）
- jquery.js（部分依赖）
- ...

外网还有些很棒的 WordPress 主题开发文档支持（有些官方都没找到的）这些文档一定程度的提升了开发进度，日后将在此补上相关链接。
