<?php
$scriptlang['tools'] = array(
	'index' => '工具箱',
	'setadmin' => '找回管理员',
	'setadmindes' => '此功能可以重置创始人以及副站长密码，在忘记密码无法进入后台的时候使用。<br/>密码留空为不重置密码，只设置管理员。',
	'setadminsuccess' => '操作成功：设置 {username} 为管理员，并添加到管理团队。',
	'setadminallow' => '未填写用户名或者 UID',
	'closesite' => '关闭站点',
	'closesitedes' => '<h2>关闭/打开站点</h2>
						<div style="font-size:12pt;">
						此处可以进行站点“关闭/打开”的操作。
						</div>',
	'success' => '操作成功 ',
	'emptypw' => '操作错误：密码为空，请重新在后台或者tools.php中设置密码',
	'loginsuccess' => '登陆成功 ',
	'error' => '密码错误无法登陆',
	'noperm' => '非站点创始人无权修改此项设置',
	'forward' => '：返回查看数据表状态',
	'repair' => '修复单表结果：',
	'successconfig' => '<font color=red>配置文件验证正确，请等待跳转到正常页面</font>',
	'updatecache' => '更新缓存',
	'updatecachedes' => '如果由于站点缓存出现问题而无法进入后台，那么可以从这里更新缓存。',
	'config' => 'UCenter 配置',
	'configdes' => '可以监控测试站点的数据库连接情况，同时可以对配置文件进行修改。<br/>注：修改配置文件前要保证配置文件可写。',
	'configerror' => '>>>>系统数据库出错<<<<',
	'configerrorcontent' => '错误内容：',
	'dblinkerror' => '数据库连接错误<br/>',
	'dbnameerror' => '数据库名称错误<br/>',
	'modiconfig' => '配置文件可写，可以在此修改配置信息为正确的配置信息<br/>',
	'editconfig' => '<br/>配置文件不可写，请手动编辑 config/config_global.php 文件，保证配置信息正确',
	'repairdb' => '修复数据库',
	'repairdbdes' => '尝试使用 repair table 命令修复数据库，如果无法修复，那么请在服务器上以命令行模式进行修复。',
	'login' => '验证',
	'logindes' => '请输入插件后台中设置的 Tools 密码，如果忘记密码而且无法进入站点后台，请查看说明文件。',
	'defaultindex' => '默认首页',
	'indextips' => '修改站点打开的时候默认的首页为哪个模块',
	'domaintips' => '修改各个模块单独的域名，格式如：forum.discuz.net，不需要加 http//:',
	'moddomain' => '模块域名绑定',
	'submit' => '修改',
	'nowindex' => '当前首页',
	'forum' => '论坛',
	'group' => '群组',
	'home' => '家园',
	'portal' => '门户',
	'file' => '文件锁',
	'iffilelock' => '是否启用文件锁',
	'use' => '使用',
	'nouse' => '不使用',
	'pass' => '密码锁',
	'password' => '密码',
	'toostips' => '此密码为 tools 外部访问接口访问密码，请妥善保管。<br/> Tools 外部接口是在站点无法访问的时候应急处理站点问题的入口，请保存好这个密码，不要透露给任何人。<br/>第一次使用无密码，请自行设置。',
	'filetips' => '选择启用，将返回一段随机字串，以此字串为文件名（不需要扩展名）新建文件上传到站点根目录中，才可以正常使用 Tools 外部接口',
	'keyname' => '文件锁文件名（不需要增加扩展名）：',
	'nokeyfile' => '文件锁文件不存在或错误，请重新上传文件锁文件',
	'logout' => '退出',
	'convert' => '转换编码',
	'nohave' => '此功能将于下个版本推出！',
	'profilefield' => '个人资料字段',
	'exportsuccess' => '导出成功，请右键另存为：<a href="{url}">{url}</a>',
	'closesecode' => '关闭验证码',
	'closesecodedes' => '如果验证码显示不正确，或者无法通过验证造成无法进入后台，可以从这里关闭验证码。',
	'gender0' => '保密',
	'gender1' => '男',
	'gender2' => '女',
	'nouser' => '没有这个用户',
	'cleardb' => '清理数据库冗余',
	'clearpost' => '清理贴子表冗余',
	'clearthread' => '清理主题表冗余',
	'clearattachment' => '清理附件表冗余',
	'clearmembers' => '清理用户表冗余',
	'clearalbum' => '清理家园相册表冗余',
	'clearpic' => '清理家园图片表冗余',
	'repairmf' => '检查用户信息表完整',
	'cleardbtips' => '<ul><li>清理贴子表冗余：清理对应主题已经不存在的回复</li>
	<li>清理主题表冗余：清理 post 无对应记录的主题，同时修复正常主题的标题，回复，附件，最后回复等参数</li>
	<li>清理附件表冗余：清理对应主题已经不存在的附件记录，并删除附件文件</li>
	<li>清理家园相册表冗余：清理相册下已经没有图片的相册，并删除封面图片</li>
	<li>清理家园图片表冗余：清理无对应相册存在了的图片，并删除图片文件</li>
	<li>检查用户信息表完整：如果您发现无法对某个用户办法勋章或者无法记录部分用户的隐私设置，请执行此项</li></ul>',
	'keyhasexpire' => '文件锁已经过期，请重新上传',
	'notsupportcheck' => '内存表不支持检查',
	'jump' => '每次跳转循环量',
	'district_backup' => '地区信息备份',
	'backup' => '备份',
	'district_renew' => '地区信息恢复',
	'renew' => '恢复',
	'district_renew_of' => '安装官方地区信息',
	'setup' => '安装',
	'backup_file' => '备份文件',
	'district_hold' => '现有备份文件',
	'bk_file_miss' => '该文件不存在',
	'district_tips' => '<li>注意：恢复地区选项将现有数据，请做好备份！</li>',
	'recoverdb' => '恢复数据库',
	'recoverdbdes' => '当站点无法打开，后台恢复数据库不成功的时候，可以使用 tools 恢复数据库',
	'recoversuccess' => '恢复备份成功，请查看论坛，如果数据不同步，请检查数据库前缀。',
	'filenoexists' => '备份文件不存在。',
	'noread' => '备份文件不可读取。',
	'wrongver' => '备份文件版本错误，不能恢复。',
	'recoveing' => '正在恢复分卷：',
	'nodicsql' => '地区SQL文件不存在，请重新上传安装包中的 install 目录',
	'successinstall' => '成功恢复地区数据，为确保安全，请删除 install 目录下的 index.php',
	'censor_admin' => '过滤词汇管理',
	'censorsearch' => '搜索过滤词',
	'find' => '不良词语',
	'tips' => '现有过滤词条数：',
	'filter' => ' 按照以下分类查看：',
	'censor_ext' => '过滤词汇增强',
	'censor_scanbbs' => '扫描帖子数据',
	'censor_scanhome' => '扫描家园数据',
	'censor_scanprotal' => '扫描门户数据',
	'censor_scangroup' => '扫描群组数据',
	'censor_exit' => '返回',
	'censor_banned' => '禁止关键词',
	'censor_mod' => '审核关键词',
	'censor_re' => '替换关键词',
	'censor_all' => '所有关键词',
	'censor_view' => '查看关键词',
	'censor_bbsinfo' => '帖子数据概况',
	'censor_homeinfo' => '家园数据概述',
	'censor_groupinfo' => '群组数据概况',
	'censor_protalinfo' => '门户数据信息',
	'censor_threadcount' => '现有主题数(主表)：',
	'censor_postcount' => '现有回复数：',
	'censor_newthreadcount' => '自上次扫描主题数增加：',
	'censor_newpostcount' => '自上次扫描回复数增加：',
	'censor_scan' => '按照过滤词汇扫描帖子',
	'censor_scantype' => '选择扫描方法',
	'censor_addscan' => '增量扫描',
	'censor_allscan' => '全部重新扫描',
	'censor_beginscan' => '开始扫描',
	'censor_scanlog' => '上次扫描',
	'censor_scantips' => '增量扫描：只扫描上次扫描之后更新的帖子<br/>全部重新扫描：扫描所有帖子',
	'censor_scantime' => '扫描时间',
	'censor_scancount' => '扫描总数',
	'censor_scanuser' => '扫描人',
	'censor_scanrep' => '替换',
	'censor_scanmod' => '审核',
	'censor_scanban' => '回收',
	'censor_noneedtoscan' => '自上次扫描无帖子更新，不需要扫描',
	'censor_jumpinto' => '当前分表 {id} 不需要扫描，进入下个分表',
	'censor_scanstart' => '正在使用 {wordstart} 到 {wordend} 个关键词<br/>扫描分表：{posttableid} 中<br/>第 {start} 至 {end} 条数据',
	'censor_homescanstart' => '正在使用 {wordstart} 到 {wordend} 个关键词<br/>扫描第 {start} 至 {end} 条数据',
	'censor_scanresult' => '扫描结束，共处理 {count} 条数据',
	'censor_jumpposttable' => '分表 {id} 扫描结束，进入下一个分表',
	'censor_blogcount' => '家园博文统计',
	'censor_commontcount' => '家园评论留言统计',
	'censor_docommentcount' => '家园心情评论统计',
	'censor_doingcount' => '家园心情统计',
	'censor_homemod' => '需要处理的内容',
	'censor_hometype' => '信息类型',
	'censor_homelink' => '跳转链接',
	'censor_articlecount' => '文章总数',
	'censor_acommontcount' => '文章评论总数',
	'home_blog' => '博文',
	'home_comment' => '评论/留言',
	'home_article' => '文章',
	'home_acomment' => '文章评论',
	'synusername' => '同步用户名',
	'clrnotice' => '清除未发送通知',
	'clrfeed' => '清理历史 FEED',
	'synuid' => '同步UID',
	'synusername_tip' => '<li>同步ucenter与discuz之间的用户名，主要修复由于更新产生的用户名显示问题。用户名将以ucenter为主。</li>',
	'clrnotice_tip' => '<li>清除ucenter未发送的通知。</li>',
	'synuid_tip' => '<li>同步ucenter与discuz之间的用户名，主要修复由于更新产生的uid问题。</li>',
	'clrfeed_tip' => '<li>该操作会自动清空 3 个月之前的存放在 UCenter 数据库中的feed，以减少 UCenter 数据库大小。</li>',
	'uc_config_no_exist' => 'ucenter配置文件不存在！',
	'step_1' => '共有',
	'step_2' => '步，现在进行到第',
	'step_3' => '步',
	'synuid_success' => '以下UID的会员的密码被重置为：1 UID:',
	'replacetid' => ' 整理主题 tid',
	'replacepid' => ' 整理回复 pid',
	'nowreplace' => '正在整理中，请勿关闭浏览器，整理进度：{percent}/9',
	'replacesuccess' => '整理完毕',
	'ucenter' => 'UCenter 相关',
	'uc_config_no_db' => 'UCenter 与 DiscuzX 使用的数据库不在同台服务器，无法进行操作',
	'uc_pm' => '短消息管理',
	'uc_viewpm' => '查询用户短消息',
	'uc_viewsend' => '查询发信人：',
	'uc_viewusername' => '查询某人短消息',
	'uc_viewto' => '查询收信人：',
	'uc_clearpm' => '清空某人短消息：',
	'uc_pmhis' => ' 用户发出的短消息记录',
	'uc_pmhli' => ' 用户相关的短信列表',
	'uc_pmlastcontent' => '最后内容',
	'uc_pmfrom' => '来自',
	'uc_pmtoer' => '接收人',
	'uc_pmusername' => '用户名',
	'uc_relausername' => '相关用户',
	'uc_pmcontent' => '内容',
	'uc_pmtime' => '时间',
	'uc_avator' => '更新用户头像状态',
	'uc_avatar_jump' => '正在更新 {start} 开始后的 {limit} 名用户的头像信息',
	'uc_avatar_done' => '用户头像信息更新完毕，升级前有头像的用户将不需要重新验证头像状态了。',
	'avator_tip' => '<li>根据已经有头像了的用户来更新用户在 DiscuzX 中的头像状态。适合刚刚升级完毕的用户使用</li>',
	'file_search' => '指定关键字搜索',
	'file_keyword' => '要搜索的关键字',
	'file_keywordtip' => '可使用通配符 * 来模糊搜索',
	'file_searchdir' => '要搜索的目录',
	'file_searchdirtip' => '如果选择的是 ./ 目录的话，考虑到性能问题将不搜索子目录，选择其他目录将搜索子目录',
	'file_nokeyword' => '没有指定关键词',
	'file_nodir' => '没有选择搜索目录，请返回选择',
	'file_realpath' => '服务器上的文件路径',
	'file_keyrows' => '关键词所在行数',
	'file_result' => '搜索的内容：',
	'file_php' => '可疑文件检查',
	'changekey' => '更换站点KEY',
	'changekey_tips' => '<li>该工具将替换您站点上的所有用于通信功能的 KEY。在不明白是做什么的时候请勿进行更换。</li><li>更换 KEY 之后可能造成 UCenter 中通信不成功，或者当前登陆用户变为退出状态。</li><li>通信失败修正方法：<a href=http://faq.comsenz.com/viewnews-588 target=_blank>http://faq.comsenz.com/viewnews-588</a></li>',
	'nowuc_key' => '当前 UCenter 通信KEY',
	'nowconfig_authkey' => '当前论坛加密 KEY（配置文件）',
	'nowsetting_authkey' => '当前安全加密 KEY2（数据库）',
	'nowmy_sitekey' => '当前漫游平台 KEY',
	'nlocaluc' => '获取不到 UCenter 配置文件，请手动重置应用管理中的通信 key<br/>',
	'resetauthkey' => '论坛安全密钥已重置，将变成退出状态<br/>',
	'mykeyerror' => '漫游服务器无法链接到您的服务器<br/>',
	'changekey_update' => '系统安全KEY已经修改完毕，情况如下：<br/>',
	'template_php' => '搜索模板目录的 php 文件',
	'attachment_php' => '搜索附件目录的 php 文件',
	'static_php' => '搜索静态文件目录的 php 文件',
	'other_php' => '搜索其他目录的 php 文件',
	'file_php_result' => '可疑文件搜索结果，请确认是否是自己的文件',
	'file_path' => 'php 文件服务器上的路径',
	'file_hack' => '扫描恶意代码',
	'nocheck' => '搜索结果为空',
	'file_hackresult' => '恶意代码所在行数，请立即检查删除！',
	'file_phptip' => '<li>下面列出的目录正常情况下都不会存在 php 文件，若存在，则有可能是后门程序</li><li>当附件目录中文件较多的时候将会耗费更多时间</li>',
	'file_hacktip' => '<li>本功能不会搜索附件目录与模板目录中的文件，请先使用“可疑文件检查”来检索这些目录中是否有PHP文件。</li><li>下面列出的是恶意代码匹配的正则，直接点击搜索即可。</li><li>所有搜索结果肯定为风险文件，请仔细检查！以免对自己的站点造成损失！</li>',
	'replacetidtip' => '此功能将改变整站的主题 tid，如果您不知道此功能的作用，请不要使用，否则后果自负',
	'replacepidtip' => '此功能将改变整站的回复 pid，如果您不知道此功能的作用，请不要使用，否则后果自负',
	'file_hackupdate' => '更新扫描规则',
	'moudle_homedomain' => '二级域名配置',
	'moudle_domain' => '是否开启家园二级域名',
	'moudle_root' => '二级域名根域名',
	'moudle_holddomain' => '保留的二级域名',
	'moudle_holddomaintip' => '所有绑定到其他模块与专题的二级域名都需要填写在这里，逗号间隔，例如：www,home,forum',
	'motion_threadclick' => '修改某个帖子点击数',
	'motion_allthreadclick' => '增加所有帖子点击数',
	'motion_tid' => '需要修改的主题的 tid',
	'motion_views' => '需要修改为的点击数',
	'motion_addviews' => '需要全局增加的点击数',
	'motion_addviews_comment' => '过多帖子会消耗过多时间，谨慎操作！',
	'motion_error' => 'tid 与点击数都必须为整数',
	'motion_hiserror' => '填写的值需要为整数',
	'motion_emptytid' => '不存在这个tid',
	'motion_success' => '修改成功 ',
	'motion_hispost' => '修改今日发帖数',
	'motion_forumpost' => '版块今日发帖数',
	'motion_forumfid' => '需要修改的版块fid',
	'motion_nofid' => '不存在这个版块',
	'moudle_cookiedomain' => 'cookie 作用域',
	'moudle_cookiedomaintip' => '如果开启了多个模块的二级域名，请设置这里为根域名，不然将不能同步登陆退出<br/>如广场域名为 bbs.comsenz.com 则这里填写 comsenz.com',
	'clearatt' => '<li>此功能将会扫描附件目录中的附件，如果数据库中不存在对应的附件则最后会给出列表是否进行删除操作。</li><li>注意：附件过多将会消耗更多时间。</li>',
	'clearatt_lajiatt' => '选择了的目录中的冗余附件',
	'clearatt_nolaji' => '该目录中不存在冗余附件，请检查其他目录',
	'clearatt_noselect' => '未选择需要删除的冗余附件',
	'move' => '搬家向导',
	'movedes' => '<h2>搬家向导</h2>
					<div style="font-size:12pt;">
					<ul>
					<li>本向导对搬家过程予以引导,搬家过程中要确保浏览器窗口运行状态，以便参考。</li>
					<li>有些步骤是需要在新空间访问本脚本的，具体见各个步骤文本说明。</li>
					<li>tools.php文件可以独立运行于网站根目录下，无需安装tools工具。</li>
					<li>搬家前也应该先确定新空间运行环境是否符合原网站运行要求。</li>
					<li>搬家过程中注意对原网站数据的保护，避免不当操作带来损失。</li>
					<li>为确保数据转移的完整性，请您事先查看原论坛站点相关系统信息，如当前数据库尺寸、当前附件尺寸等等，搬到新服务器空间后以便对照数据的大小完整度。</li>
					</ul></div>
					',
	'check' => '搬家向导 》选择类型',
	'checkdes' => '请选择您的服务器类型，点击进入。',
	'backupwind' => '搬家向导 》Windows主机',
	'backupwinddes' =>  '<h2>第一步----停止MySQL</h2><br />
							<div style="width:400px; font-size:12pt;">
							必须停止MySQL服务。<br />
							开始 - 运行 - 输入cmd - 回车<br />
							运行 net start |findstr /i my <br />
							查找自己MySQL服务名，一般情况下，都是mysql。
							在命令行窗口输入：<br />
							net stop mysql <br />
							回车，停止MySQL服务。
							出现上图所示，就可以点下一步了。
							</div>
							',
	'win2' => '搬家向导 》Windows主机',
	'win2des' => '<h2>第二步----打包MySQL数据</h2><br />
					<div style="width:400px; font-size:12pt;">
					进入MySQL所在目录，打包',
	'win2dess' => '目录为data.zip，
					打包文件时一定要在文件所在目录全选，然后打包，不然直接打包data。
					解压后会生成新一级data目录。
					出现如右图所示，就可以点下一步了。
					</div>',
	'win3' => '搬家向导 》Windows主机',
	'win3des' => '<h2>第三步----打包程序文件</h2><br />
				<div style="width:400px; font-size:12pt;">
					进入网站根目录(',
	'win3dess' => ')，打包此目录下的所有文件为web.zip。
					打包文件时一定要在文件所在目录全选，然后压缩打包，不然直接打包web文件夹，解压后会生成新一级web目录。
					按图操作，点确定，压缩完就可以点下一步了。
					</div>',
	'win4' => '搬家向导 》Windows主机',
	'win4des' => '<h2>第四步----移动打包文件</h2><br />
					<div style="width:400px; font-size:12pt;">
					把刚才打包好的两个备份包全部移动到网站根目录下（',
	'clearatt_done' => '已经删除选择的冗余附件',
	'ver_has' => '当前版本已经内置此功能，请到对应位置设置',
	'convert_scharset' => '点击提交将进行编码转换（反复提交将清空之前转换了的数据）',
	'win4dess' => '）
						出现如右图所示，就可以点下一步了。
						</div>',
	'win5' => '搬家向导 》Windows主机',
	'win5des' => '<h2>第五步----测试压缩包位置</h2><br />
					<div style="width:400px; font-size:12pt;">
						在浏览器中测试上一步中放置好的备份包能否被访问到。
						打开浏览器页面，输入网站的网址测试：<br />（http://www.aaa.com/）为您站点地址。<br />
						测试数据库备份包访问地址：http://www.aaa.com/data.zip<br />
						测试网站文件备份包访问地址：http://www.aaa.com/web.zip<br />
						如果都能正常弹出下载窗口，说明文件已经能正常访问并可以下载。<br />
						我们在原服务器上的备份工作就已经完成了。
						</div>',
	'win6' => '搬家向导 》Windows主机',
	'win6des' => '<h2>第六步----下载数据库压缩包到新空间</h2><br />
					<div style="width:400px; font-size:12pt;">
						<b>注意：以下步骤需在新空间完成。</b><br />
						下载原服务器数据库备份包到新服务器。<br />
						如右图操作，指定好下载位置，下载完毕，就可以点下一步了。
						</div>',
	'win7' => '搬家向导 》Windows主机',
	'win7des' => '<h2>第七步----解压文件</h2><br />
					<div style="width:400px; font-size:12pt;">
						下载后得到data.zip文件，接下来要解压此备份包。<br />
						解压完毕后得到data目录，这个目录就是网站的数据库，数据库名就是data。<br />
						按图操作，解压完毕后，就可以点下一步了。
						</div>',
	'win8' => '搬家向导 》Windows主机',
	'win8des' => '<h2>第八步----重启MySQL服务</h2><br />
					<div style="width:400px; font-size:12pt;">
						解压后的数据库暂时还不能使用，需要重新启动MySQL服务才能完全生效。<br />
						停止MySQL的命令为:net stop mysl<br />
						开启MySQL的命令为:net start mysql<br />这个MySQL服务名和第一步获取的方式一样。
						重启完毕后数据库即可使用，需要用新服务器上MySQL的root权限登录调用，其他权限自行设置。<br />
						出现如上图所示，就可以点下一步了。
						</div>',
	'win9' => '搬家向导 》Windows主机',
	'win9des' => '<h2>第九步----下载程序文件压缩包</h2><br />
					<div style="width:400px; font-size:12pt;">
						进入新服务器的网站根目录，下载原服务器上的原文件备份包到新服务器。<br />
						按图操作，指定好下载位置，下载完毕，就可以点下一步了。
						</div>',
	'win10' => '搬家向导 》Windows主机',
	'win10des' => '<h2>第十步----解压web压缩包</h2><br />
					<div style="width:400px; font-size:12pt;">
						下载完成后，得到web.zip文件，接下来要解压此备份包。<br />
						解压完毕后，就算基本完成了数据的恢复。<br />
						在IIS里指定站点的根目录到web目录下，就可以点下一步了。
						</div>',
	'win11' => '搬家向导 》Windows主机',
	'win11des' => '<h2>第十一步----绑定IP</h2>
					<div style=" font-size:12pt;">
						<b>注意：本步骤必须在新空间执行。</b><br />
						设置好新服务器数据库帐号密码之前，可以解析域名到新服务器的IP，或者修改本地hosts文件绑定域名。<br />
						这里强调域名问题，旨在本步骤操作完成后，需要更新缓存，涉及到缓存路径的问题。<br />
						hosts文件具体修改方法可以参考：<a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高对经常访问的网络域名的解析效率</u></a><br /> 
						绑定完域名后便可以访问自己的新站点。
						</div>',
	'win12' => '搬家向导 》Windows主机',
	'win12des' => '<h2>第十二步----修改数据库帐号密码</h2>',
	'win13' => '搬家向导 》Windows主机',
	'win13des' => '<h2>第十三步----修改数据库帐号密码</h2>',
	'win14' => '搬家向导 》Windows主机',
	'win14des' => '<h2>第十四步----更新缓存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完数据库帐号，下一步就是更新缓存了。<br />
						点击',
	'win14dess' => '按钮，会新开一个页面,执行更新缓存，待更新缓存完毕后，回到本引导页面进入下一步。
						</div>',
	'win15' => '搬家向导 》Windows主机',
	'win15des' => '<h2>第十五步----打开站点</h2>
				<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'win16' => '搬家向导 》Windows主机',
	'win16des' => '<h2>最后一步----浏览站点</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'backuplinux' => '搬家向导 》Linux主机',
	'backuplinuxdes' => '<h2>第一步----停止MySQL服务</h2><br />
						<div style=" font-size:12pt;">
							必须停止MySQL服务。<br />
							执行ll /etc/init.d/ |grep my 得到MySQL服务名。<br />
							在命令行窗口输入service mysqld stop 回车（mysqld为查找到的MySQL服务名）。<br />
							出现如右图所示，就可以点下一步了。
							</div>',
	'lin2' => '搬家向导 》Linux主机',
	'lin2des' => '<h2>第二步----打包MySQL数据</h2><br />
					<div style=" font-size:12pt;">
						进入MySQL所在目录，打包（',
	'lin2dess' => '）目录下文件为data.tar.gz。 <br />
						打包命令为：tar zcvf data.tar.gz data<br />
						打包文件时一定要在文件所在目录全选，然后打包，不然直接打包data，
						解压后会生成新一级data目录。
						出现如上图所示，就可以点下一步了。
						</div>',
	'lin3' => '搬家向导 》Linux主机',
	'lin3des' => '<h2>第三步----打包程序文件</h2><br />
					<div style=" font-size:12pt;">
						进入网站根目录',
	'lin3dess' => '，打包此目录下的文件为web.tar.gz<vr />
						打包命令为：<br />tar zcvf web.tar.gz *<br />
						打包文件时一定要在文件所在目录全选，然后打包，不然直接打包根目录，
						解压后会生成新一级根目录名。
						出现如上图所示，就可以点下一步了。
						</div>',
	'lin4' => '搬家向导 》Linux主机',
	'lin4des' => '<h2>第四步----移动MySQL备份压缩包</h2><br />
					<div style=" font-size:12pt;">
						把刚才打包好的两个备份包全部移动到网站根目录下。<br />
						移动的命令为：<br />mv ',
	'convert_dbbase' => '将转换的数据库',
	'convert_curcharset' => '当前数据库编码',
	'convert_tocharset' => '将要转换到的编码',
	'convert_serilise' => '数据编码转换完毕，修复序列化数据。',
	'convert_count' => '所有的表创建完成，数据库共有 {count} 个表！',
	'convert_converting' => '正在转移 {table} 表的从 {start} 条记录开始的后 {limit} 条记录',
	'convert_done' => '转换成功，转换后的表前缀为 {todbcharset}_pre_ 请自行修改 配置文件中对应的编码与数据库前缀',
	'lin4dess' => 'web.tar.gz ',
	'lin4desss' => 'mv ',
	'lin4desbb' =>'data.tar.gz ',
	'lin4desbbb' => '<br /><img src="source/plugin/tools/template/image/lin/4.jpg"><br />
						出现如上图所示，就可以点下一步了。
						</div>',
	'lin5' => '搬家向导 》Linux主机',
	'lin5des' => '<h2>第五步----测试压缩包位置</h2><br />
					<div style=" font-size:12pt;">
						用浏览器测试上一步中放置好的备份包能否被访问。<br />
						打开浏览器页面，输入网站的网址测试：<br />
						http://www.aaa.com/为您站点地址。<br />
						测试数据库备份包访问地址：http://www.aaa.com/data.tar.gz<br />
						测试网站文件备份包访问地址：http://www.aaa.com/web.tar.gz<br />
						如果都能正常弹出下载窗口，说明文件已经能正常访问并可以下载。<br />
						我们在原服务器上的备份工作就已经完成了。<br />
						</div>',
	'lin6' => '搬家向导 》Linux主机',
	'lin6des' => '<h2>第六步----下载MySQL压缩包</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：以下步骤需要在新空间完成。</b><br />
						进入MySQL的data目录，下载原服务器上的数据库备份包到新服务器。<br />
						下载命令为：<br />wget http://www.aaa.com/data.tar.gz<br />
						www.aaa.com/为你原站点域名。<br />
						按照右图所示操作后，就可以点下一步了。
						</div>',
	'lin7' => '搬家向导 》Linux主机',
	'lin7des' => '<h2>第七步----解压MySQL压缩包</h2><br />
					<div style=" font-size:12pt;">	
						下载完data.tar.gz文件，接下来要解压此备份包。<br />
						解压命令为：<br />tar zxvf data.tar.gz<br />
						解压完毕后得到data目录，这个目录就是网站的数据库。<br />
						出现如上图所示，就可以点下一步了。
						</div>',
	'lin8' => '搬家向导 》Linux主机',
	'lin8des' => '<h2>第八步----重启MySQL服务</h2><br />
					<div style=" font-size:12pt;">
						解压后数据库暂时不能使用，需要重新启动MySQL服务才能生效。
						重启MySQL的命令为：<br />service mysqld restart<br />
						重启完毕后数据库即可使用，需要用新服务器上MySQL的root权限登录调用，其他权限自行设置。<br />
						出现如右图所示，就可以点下一步了。
						</div>',
	'lin9' => '搬家向导 》Linux主机',
	'lin9des' => '<h2>第九步----下载原站点文件压缩包</h2><br />
					<div style=" font-size:12pt;">
						进入新服务器的网站根目录，下载原服务器上的备份包到新服务器
						下载命令为：<br />wget http://www.aaa.com/web.tar.gz<br />
						出现如右图所示，就可以点下一步了。
						</div>',
	'lin10' => '搬家向导 》Linux主机',
	'lin10des' => '<h2>第十步----解压缩原站点文件压缩包</h2><br />
					<div style=" font-size:12pt;">
						下载完成后，得到web.tar.gz文件，接下来要解压此备份包。<br />
						解压命令为：tar zxvf web.tar.gz<br />
						解压完毕后，就算基本完成了数据的恢复<br />
						出现如上图所示，就可以点下一步了。
						</div>',
	'lin11' => '搬家向导 》Linux主机',
	'lin11des' => '<h2>第十一步----更改数据库帐号密码</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：本步骤必须在新空间执行。</b><br />
						设置好新服务器数据库帐号密码之前，可以解析域名到新服务器的IP，或者修改本地hosts文件绑定域名。<br />
						这里强调域名问题，旨在本步骤操作完成后，需要更新缓存，涉及到缓存路径的问题。<br />
						hosts文件具体修改方法可以参考：<a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高对经常访问的网络域名的解析效率</u></a><br /> 
						绑定完域名后便可以访问自己的新站点。
						</div>',
	'lin12' => '搬家向导 》Linux主机',
	'lin12des' => '<h2>第十二步----修改数据库帐号密码</h2>',
	'lin13' => '搬家向导 》Linux主机',
	'lin13des' => '<h2>第十三步----修改数据库帐号密码</h2>',
	'lin14' => '搬家向导 》Linux主机',
	'lin14des' => '<h2>第十四步----更新缓存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完数据库帐号，下一步就是更新缓存了。<br />
						点击',
	'lin14dess' => '按钮，会新开一个页面,执行更新缓存，待更新缓存完毕后，回到本引导页面进入下一步。
						</div>',
	'lin15' => '搬家向导 》Linux主机',
	'lin15des' => '<h2第十五步----打开站点</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'lin16' => '搬家向导 》Linux主机',
	'lin16des' => '<h2>最后一步----浏览站点</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'backupxn' => '搬家向导 》虚拟主机',
	'backupxndes' => '<h2>第一步----简要概述</h2><br /><br />
					<div style=" font-size:12pt;">
							虚拟主机备份文件的方法很单一，只有两种办法：<br />
							1.在主机面板打包或要求主机商打包，下载备份包到本地。<br />
							2.直接用FTP把所有网站根目录下的文件下载到本地。<br />
							恢复的方法也很单一，还是两种办法：<br />
							1.上传备份包到虚拟主机上，在面板解包恢复或者要求主机商解包恢复。<br />
							2.直接用FTP把所有网站根目录下的文件上传到新空间的网站根目录。
							下面就去关闭站点，备份数据库。<br />
							如果已经把所有文件都移动到了新空间，那么可以点击',
	'house_export' => '备份房产数据',
	'backupxndess' => '按钮。
						</div>',
	'xn3' => '搬家向导 》虚拟主机',
	'xn3des' => '<h2>第三步----备份数据库</h2><br />
					<div style=" font-size:12pt;">
						关闭论坛后，就可以备份数据库了。<br />
						点击下面的链接去备份数据库，下面的链接会在新标签页打开，请确保本页面运行。<br />
						备份数据库需要注意的是，如果UCenter和论坛是在同一个数据库中，则可按照默认方式备份数据。<br />
						如果UCenter和论坛不在同一个数据库，那么需要单独备份UCenter。<br />
						点击',
	'xn3dess' =>'按钮，会打开新窗口，本窗口不要关闭。备份完毕后，再回到本引导窗口。<br />备份完数据库就可以进入下一步操作。<br />
						</div>',
	'xn4' => '搬家向导 》虚拟主机',
	'xn4des' => '<h2>第四步----压缩文件</h2><br />
					<div style=" font-size:12pt;">
						到控制面板打包文件并下载，一般情况下虚拟主机都会有在线压缩、解压文件功能，具体见右图。<br />
						压缩后生成的文件名一般都是可以自己定义的，也有些是以系统时间命名的；<br />压缩时，要从根目录文件
						处压缩，因为如果在顶级目录压缩，解压时会多产生一层目录。<br />
						压缩打包好后，可以用FTP工具下载了，如果空间不支持文件压缩，可以直接用FTP软件直接下载文件到本地。
						</div>',
	'xn5' => '搬家向导 》虚拟主机',
	'xn5des' => '<h2>第五步----上传压缩包</h2><br />
					<div style=" font-size:12pt;">
						上传原站点文件压缩包到新空间，一般虚拟空间根目录文件名称为wwwroot或httpdocs，也有是直接根目录的。
						没压缩功能的，只能通过ftp上传文件到新空间。
						</div>',
	'xn6' => '搬家向导 》虚拟主机',
	'xn6des' => '<h2>第六步----解压压缩包</h2><br />
				<div style=" font-size:12pt;">
					解压压缩包到新空间根目录。 <br />
					解压缩与压缩功能一般在空间控制面板的同一处。 <br />
					此时注意解压后的文件所处位置，是否正确。 <br />
					这个类似于wwwroot的目录，是指绑定了域名或ip后的目录。 <br />
					修改完配置文件后，就可以登录网站后台，更新缓存了。 <br />
					下一步就是去更新配置文件中的数据库帐号密码。<br />
					<b>注意：以下步骤必须在新空间完成，即在新空间访问tools.php文件</b><br />
					</div>',
	'xn7' => '搬家向导 》虚拟主机',
	'xn7des' => '<h2>第八步----修改数据库帐号密码</h2>',
	'xn8' => '搬家向导 》虚拟主机',
	'xn8des' => '<h2>第九步----修改数据库帐号密码</h2>',
	'xn9' => '搬家向导 》虚拟主机',
	'xn9des' => '<h2>第十步----恢复数据库</h2><br /><br />
					<div style=" font-size:12pt;">
						修改好数据库帐号后，确定域名已经处理完毕，就可以恢复数据库了，点击',
	'xn9dess' => '按钮，会跳到新页面执行恢复数据，执行完毕再回到本引导页。<br />
				如果执行完了数据库恢复，请点击下一步。		</div>',
	'xn10' => '搬家向导 》虚拟主机',
	'xn10des' => '<h2>第十一步----更新缓存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完数据库帐号，恢复完数据库，下一步就是更新缓存了。<br />
						点击',
	'xn10dess' => '按钮，会新开一个页面,执行更新缓存，待更新缓存完毕后，回到本引导页面进入下一步。
						</div>',
	'xn11' => '搬家向导 》虚拟主机',
	'xn11des' => '<h2>第十二步----打开站点</h2>
				<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'xn12' => '搬家向导 》虚拟主机',
	'xn12des' => '<h2>最后一步----浏览站点</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完后，就可以打开新站点了。<br />
					打开新站点后可以参照之前原站点数据库大小和文件附件大小，比对新站点。
					</div>',
	'xn13' => '搬家向导 》虚拟主机',
	'xn13des' => '<h2>第七步----绑定域名</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：从本步骤起，必须在新空间执行。</b><br />
						设置好新服务器数据库帐号密码之前，可以解析域名到新服务器的IP，或者修改本地hosts文件绑定域名。<br />
						这里强调域名问题，旨在本步骤操作完成后，需要更新缓存，涉及到缓存路径的问题。<br />
						hosts文件具体修改方法可以参考： <br /><a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高对经常访问的网络域名的解析效率</u></a><br /> 
						绑定完域名后便可以访问自己的新站点。
						</div>',
	'noclosed' => '站点未关闭，请关闭站点，再进行下一步',
	'clearmodereter' => '清理审核冗余数据',
	'clearmodereter_suc' => '清理审核冗余数据完成',
	'ucdbnames' => 'UCenter数据库名错误，请返回。',
	'bbsdbnames' => '论坛数据库名错误，请返回。',
	'uchost' => 'UCenter数据库帐号错误，请返回。',
	'bbshost' => '论坛数据库帐号错误，请返回。',
);

$templatelang['tools'] = array(
	'nowadminer' => '现有管理员（副站长）：',
	'nowfounder' => '现有创始人',
	'username' => '用户名',
	'passwordtip' => '请输入密码',
	'issecquesreset' => '是否清除安全提问',
	'yes' => '是',
	'no' => '否',
	'submit' => '提交',
	'sitestatu' => '站点当前状态',
	'open' => '打开',
	'close' => '关闭',
	'closereason' => '关闭理由',
	'updatedata' => '更新数据缓存',
	'updatetemplates' => '更新模板缓存',
	'updatedatatip' => '模板显示错位问题请更新模板缓存',
	'updatetemplatestip' => '站点无法打开，或者设置未生效，可以尝试更新数据缓存',
	'sitedbstatu' => '站点数据库连接',
	'sitedbext' => '站点数据库',
	'ucapi' => 'UCenter 地址：',
	'ucdbstatu' => 'UCenter 数据库连接',
	'ucdbext' => 'UCenter 数据库',
	'ext' => '<span class=green>存在</span>',
	'noext' => '<span class=red>不存在</span>',
	'right' => '<span class=green>正常</span>',
	'failed' => '<span class=red>失败</span>',
	'dbhost' => 'Mysql 地址：',
	'dbuser' => 'Mysql 账号：',
	'dbpw' => 'Mysql 密码：',
	'dbname' => '站点数据库名称：',
	'dbpre' => '站点数据库表前缀：',
	'ucdbhost' => 'UCenter 数据库地址：',
	'ucdbuser' => 'UCenter 数据库账号：',
	'ucdbpw' => 'UCenter 数据库密码：',
	'ucdbname' => 'UCenter 数据库名称：',
	'ucdbpre' => 'UCenter 数据库表前缀：',
	'ucip' => 'UCenter IP：',
	'password' => '密码：',
	'nopassword' => '未设置 Tools 密码，请设置密码后访问。',
	'toolswelcome' => '欢迎使用 Tools 工具外部接口，请从右侧选择需要设置的项目。',
	'suggest' => '对 Tools 有更好的意见与建议，请反馈到官方论坛。',
	'gotodiscuz' => '跳转到 Discuz! 官方论坛',
	'secodestatu' => '当前验证码状态',
	'closesecode' => '关闭验证码',
	'nosecode' => '提示：当前站点未启用验证码。',
	'havesecode' => '提示：当前站点使用了验证码。',
	'tablename' => '表名',
	'tablesize' => '大小',
	'allcheck' => '全部检查',
	'allrepair' => '全部修复',
	'check' => '检查',
	'repair' => '修复',
	'baktiem' => '备份项目',
	'version' => '版本',
	'time' => '时间',
	'type' => '类型',
	'total' => '文件总数',
	'import' => '导入',
	'authtypeb' => '当前验证模式为安全模式，密码为在站点后台插件面板中设置的密码。<br/>当前后台可以启用密钥验证',
	'authtypea' => '当前验证模式为临时模式，密码为 tools.php 文件中的设置的密码。请在使用后修改。',
	'mback' => '上一步',
	'mnext' => '下一步',
	'startm' => '开始搬家',
	'win' => 'Windows主机搬家',
	'lin' => 'Linux主机搬家',
	'xn' => '虚拟主机搬家',
	'newconfig' => '下一步，更改配置文件',
	'dbusername' => '数据库用户名',
	'mdbpw' => '数据库密码',
	'mdbname' => '数据库名',
	'mupdatechache' => '更新缓存',
	'mopensite' => '打开站点',
	'viewsite' => '浏览站点',
	'innew' => '我已经到新空间了',
	'nextclose' => '下一步，关闭站点',
	'backupdb' => '数据库备份',
	'overdb' => '数据库备份完毕，下一步',
	'uploadzip' => '已上传压缩包，下一步',
	'downzip' => '已下载压缩包，下一步',
	'ipdns' => '下一步，绑定域名',
);

$installlang['tools'] = array(
	'menu_exttools_pw' => '密码设置',
	'menu_exttools_moudle' => '模块相关设置',
	'menu_exttools_cleardb' => '清理数据库冗余',
	'menu_exttools_exportdata' => '导出个人信息',
	'menu_exttools_district' => '地区备份/恢复',
	'menu_exttools_censor' => '敏感词管理',
	'menu_exttools_ucenter' => 'UCenter相关',
	'menu_exttools_safe' => '安全工具',
	'menu_exttools_motion' => '运营工具',
	'menu_exttools_att' => '附件清理',
	'menu_exttools_convert' => '编码转换',
	'menu_exttools_house' => '房产备份',
);

?>