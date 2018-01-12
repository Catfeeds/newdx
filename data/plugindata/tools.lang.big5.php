<?php
$scriptlang['tools'] = array(
	'index' => '工具箱',
	'setadmin' => '找回管理員',
	'setadmindes' => '此功能可以重置創始人以及副站長密碼，在忘記密碼無法進入後台的時候使用。<br/>密碼留空為不重置密碼，只設置管理員。',
	'setadminsuccess' => '操作成功：設置 {username} 為管理員，並添加到管理團隊。',
	'setadminallow' => '未填寫用戶名或者 UID',
	'closesite' => '關閉站點',
	'closesitedes' => '<h2>關閉/打開站點</h2>
						<div style="font-size:12pt;">
						此處可以進行站點「關閉/打開」的操作。
						</div>',
	'success' => '操作成功 ',
	'emptypw' => '操作錯誤：密碼為空，請重新在後台或者tools.php中設置密碼',
	'loginsuccess' => '登陸成功 ',
	'error' => '密碼錯誤無法登陸',
	'noperm' => '非站點創始人無權修改此項設置',
	'forward' => '：返回查看數據表狀態',
	'repair' => '修復單表結果：',
	'successconfig' => '<font color=red>配置文件驗證正確，請等待跳轉到正常頁面</font>',
	'updatecache' => '更新緩存',
	'updatecachedes' => '如果由於站點緩存出現問題而無法進入後台，那麼可以從這裡更新緩存。',
	'config' => 'UCenter 配置',
	'configdes' => '可以監控測試站點的數據庫連接情況，同時可以對配置文件進行修改。<br/>註：修改配置文件前要保證配置文件可寫。',
	'configerror' => '>>>>系統數據庫出錯<<<<',
	'configerrorcontent' => '錯誤內容：',
	'dblinkerror' => '數據庫連接錯誤<br/>',
	'dbnameerror' => '數據庫名稱錯誤<br/>',
	'modiconfig' => '配置文件可寫，可以在此修改配置信息為正確的配置信息<br/>',
	'editconfig' => '<br/>配置文件不可寫，請手動編輯 config/config_global.php 文件，保證配置信息正確',
	'repairdb' => '修復數據庫',
	'repairdbdes' => '嘗試使用 repair table 命令修復數據庫，如果無法修復，那麼請在服務器上以命令行模式進行修復。',
	'login' => '驗證',
	'logindes' => '請輸入插件後台中設置的 Tools 密碼，如果忘記密碼而且無法進入站點後台，請查看說明文件。',
	'defaultindex' => '默認首頁',
	'indextips' => '修改站點打開的時候默認的首頁為哪個模塊',
	'domaintips' => '修改各個模塊單獨的域名，格式如：forum.discuz.net，不需要加 http//:',
	'moddomain' => '模塊域名綁定',
	'submit' => '修改',
	'nowindex' => '當前首頁',
	'forum' => '論壇',
	'group' => '群組',
	'home' => '家園',
	'portal' => '門戶',
	'file' => '文件鎖',
	'iffilelock' => '是否啟用文件鎖',
	'use' => '使用',
	'nouse' => '不使用',
	'pass' => '密碼鎖',
	'password' => '密碼',
	'toostips' => '此密碼為 tools 外部訪問接口訪問密碼，請妥善保管。<br/> Tools 外部接口是在站點無法訪問的時候應急處理站點問題的入口，請保存好這個密碼，不要透露給任何人。<br/>第一次使用無密碼，請自行設置。',
	'filetips' => '選擇啟用，將返回一段隨機字串，以此字串為文件名（不需要擴展名）新建文件上傳到站點根目錄中，才可以正常使用 Tools 外部接口',
	'keyname' => '文件鎖文件名（不需要增加擴展名）：',
	'nokeyfile' => '文件鎖文件不存在或錯誤，請重新上傳文件鎖文件',
	'logout' => '退出',
	'convert' => '轉換編碼',
	'nohave' => '此功能將於下個版本推出！',
	'profilefield' => '個人資料字段',
	'exportsuccess' => '導出成功，請右鍵另存為：<a href="{url}">{url}</a>',
	'closesecode' => '關閉驗證碼',
	'closesecodedes' => '如果驗證碼顯示不正確，或者無法通過驗證造成無法進入後台，可以從這裡關閉驗證碼。',
	'gender0' => '保密',
	'gender1' => '男',
	'gender2' => '女',
	'nouser' => '沒有這個用戶',
	'cleardb' => '清理數據庫冗余',
	'clearpost' => '清理貼子表冗余',
	'clearthread' => '清理主題表冗余',
	'clearattachment' => '清理附件表冗余',
	'clearmembers' => '清理用戶表冗余',
	'clearalbum' => '清理家園相冊表冗余',
	'clearpic' => '清理家園圖片表冗余',
	'repairmf' => '檢查用戶信息表完整',
	'cleardbtips' => '<ul><li>清理貼子表冗余：清理對應主題已經不存在的回復</li>
	<li>清理主題表冗余：清理 post 無對應記錄的主題，同時修復正常主題的標題，回復，附件，最後回復等參數</li>
	<li>清理附件表冗余：清理對應主題已經不存在的附件記錄，並刪除附件文件</li>
	<li>清理家園相冊表冗余：清理相冊下已經沒有圖片的相冊，並刪除封面圖片</li>
	<li>清理家園圖片表冗余：清理無對應相冊存在了的圖片，並刪除圖片文件</li>
	<li>檢查用戶信息表完整：如果您發現無法對某個用戶辦法勳章或者無法記錄部分用戶的隱私設置，請執行此項</li></ul>',
	'keyhasexpire' => '文件鎖已經過期，請重新上傳',
	'notsupportcheck' => '內存表不支持檢查',
	'jump' => '每次跳轉循環量',
	'district_backup' => '地區信息備份',
	'backup' => '備份',
	'district_renew' => '地區信息恢復',
	'renew' => '恢復',
	'district_renew_of' => '安裝官方地區信息',
	'setup' => '安裝',
	'backup_file' => '備份文件',
	'district_hold' => '現有備份文件',
	'bk_file_miss' => '該文件不存在',
	'district_tips' => '<li>注意：恢復地區選項將現有數據，請做好備份！</li>',
	'recoverdb' => '恢復數據庫',
	'recoverdbdes' => '當站點無法打開，後台恢復數據庫不成功的時候，可以使用 tools 恢復數據庫',
	'recoversuccess' => '恢復備份成功，請查看論壇，如果數據不同步，請檢查數據庫前綴。',
	'filenoexists' => '備份文件不存在。',
	'noread' => '備份文件不可讀取。',
	'wrongver' => '備份文件版本錯誤，不能恢復。',
	'recoveing' => '正在恢復分卷：',
	'nodicsql' => '地區SQL文件不存在，請重新上傳安裝包中的 install 目錄',
	'successinstall' => '成功恢復地區數據，為確保安全，請刪除 install 目錄下的 index.php',
	'censor_admin' => '過濾詞彙管理',
	'censorsearch' => '搜索過濾詞',
	'find' => '不良詞語',
	'tips' => '現有過濾詞條數：',
	'filter' => ' 按照以下分類查看：',
	'censor_ext' => '過濾詞彙增強',
	'censor_scanbbs' => '掃瞄帖子數據',
	'censor_scanhome' => '掃瞄家園數據',
	'censor_scanprotal' => '掃瞄門戶數據',
	'censor_scangroup' => '掃瞄群組數據',
	'censor_exit' => '返回',
	'censor_banned' => '禁止關鍵詞',
	'censor_mod' => '審核關鍵詞',
	'censor_re' => '替換關鍵詞',
	'censor_all' => '所有關鍵詞',
	'censor_view' => '查看關鍵詞',
	'censor_bbsinfo' => '帖子數據概況',
	'censor_homeinfo' => '家園數據概述',
	'censor_groupinfo' => '群組數據概況',
	'censor_protalinfo' => '門戶數據信息',
	'censor_threadcount' => '現有主題數(主表)：',
	'censor_postcount' => '現有回複數：',
	'censor_newthreadcount' => '自上次掃瞄主題數增加：',
	'censor_newpostcount' => '自上次掃瞄回複數增加：',
	'censor_scan' => '按照過濾詞彙掃瞄帖子',
	'censor_scantype' => '選擇掃瞄方法',
	'censor_addscan' => '增量掃瞄',
	'censor_allscan' => '全部重新掃瞄',
	'censor_beginscan' => '開始掃瞄',
	'censor_scanlog' => '上次掃瞄',
	'censor_scantips' => '增量掃瞄：只掃瞄上次掃瞄之後更新的帖子<br/>全部重新掃瞄：掃瞄所有帖子',
	'censor_scantime' => '掃瞄時間',
	'censor_scancount' => '掃瞄總數',
	'censor_scanuser' => '掃瞄人',
	'censor_scanrep' => '替換',
	'censor_scanmod' => '審核',
	'censor_scanban' => '回收',
	'censor_noneedtoscan' => '自上次掃瞄無帖子更新，不需要掃瞄',
	'censor_jumpinto' => '當前分表 {id} 不需要掃瞄，進入下個分表',
	'censor_scanstart' => '正在使用 {wordstart} 到 {wordend} 個關鍵詞<br/>掃瞄分表：{posttableid} 中<br/>第 {start} 至 {end} 條數據',
	'censor_homescanstart' => '正在使用 {wordstart} 到 {wordend} 個關鍵詞<br/>掃瞄第 {start} 至 {end} 條數據',
	'censor_scanresult' => '掃瞄結束，共處理 {count} 條數據',
	'censor_jumpposttable' => '分表 {id} 掃瞄結束，進入下一個分表',
	'censor_blogcount' => '家園博文統計',
	'censor_commontcount' => '家園評論留言統計',
	'censor_docommentcount' => '家園心情評論統計',
	'censor_doingcount' => '家園心情統計',
	'censor_homemod' => '需要處理的內容',
	'censor_hometype' => '信息類型',
	'censor_homelink' => '跳轉鏈接',
	'censor_articlecount' => '文章總數',
	'censor_acommontcount' => '文章評論總數',
	'home_blog' => '博文',
	'home_comment' => '評論/留言',
	'home_article' => '文章',
	'home_acomment' => '文章評論',
	'synusername' => '同步用戶名',
	'clrnotice' => '清除未發送通知',
	'clrfeed' => '清理歷史 FEED',
	'synuid' => '同步UID',
	'synusername_tip' => '<li>同步ucenter與discuz之間的用戶名，主要修復由於更新產生的用戶名顯示問題。用戶名將以ucenter為主。</li>',
	'clrnotice_tip' => '<li>清除ucenter未發送的通知。</li>',
	'synuid_tip' => '<li>同步ucenter與discuz之間的用戶名，主要修復由於更新產生的uid問題。</li>',
	'clrfeed_tip' => '<li>該操作會自動清空 3 個月之前的存放在 UCenter 數據庫中的feed，以減少 UCenter 數據庫大小。</li>',
	'uc_config_no_exist' => 'ucenter配置文件不存在！',
	'step_1' => '共有',
	'step_2' => '步，現在進行到第',
	'step_3' => '步',
	'synuid_success' => '以下UID的會員的密碼被重置為：1 UID:',
	'replacetid' => ' 整理主題 tid',
	'replacepid' => ' 整理回復 pid',
	'nowreplace' => '正在整理中，請勿關閉瀏覽器，整理進度：{percent}/9',
	'replacesuccess' => '整理完畢',
	'ucenter' => 'UCenter 相關',
	'uc_config_no_db' => 'UCenter 與 DiscuzX 使用的數據庫不在同台服務器，無法進行操作',
	'uc_pm' => '短消息管理',
	'uc_viewpm' => '查詢用戶短消息',
	'uc_viewsend' => '查詢發信人：',
	'uc_viewusername' => '查詢某人短消息',
	'uc_viewto' => '查詢收信人：',
	'uc_clearpm' => '清空某人短消息：',
	'uc_pmhis' => ' 用戶發出的短消息記錄',
	'uc_pmhli' => ' 用戶相關的短信列表',
	'uc_pmlastcontent' => '最後內容',
	'uc_pmfrom' => '來自',
	'uc_pmtoer' => '接收人',
	'uc_pmusername' => '用戶名',
	'uc_relausername' => '相關用戶',
	'uc_pmcontent' => '內容',
	'uc_pmtime' => '時間',
	'uc_avator' => '更新用戶頭像狀態',
	'uc_avatar_jump' => '正在更新 {start} 開始後的 {limit} 名用戶的頭像信息',
	'uc_avatar_done' => '用戶頭像信息更新完畢，升級前有頭像的用戶將不需要重新驗證頭像狀態了。',
	'avator_tip' => '<li>根據已經有頭像了的用戶來更新用戶在 DiscuzX 中的頭像狀態。適合剛剛升級完畢的用戶使用</li>',
	'file_search' => '指定關鍵字搜索',
	'file_keyword' => '要搜索的關鍵字',
	'file_keywordtip' => '可使用通配符 * 來模糊搜索',
	'file_searchdir' => '要搜索的目錄',
	'file_searchdirtip' => '如果選擇的是 ./ 目錄的話，考慮到性能問題將不搜索子目錄，選擇其他目錄將搜索子目錄',
	'file_nokeyword' => '沒有指定關鍵詞',
	'file_nodir' => '沒有選擇搜索目錄，請返回選擇',
	'file_realpath' => '服務器上的文件路徑',
	'file_keyrows' => '關鍵詞所在行數',
	'file_result' => '搜索的內容：',
	'file_php' => '可疑文件檢查',
	'changekey' => '更換站點KEY',
	'changekey_tips' => '<li>該工具將替換您站點上的所有用於通信功能的 KEY。在不明白是做什麼的時候請勿進行更換。</li><li>更換 KEY 之後可能造成 UCenter 中通信不成功，或者當前登陸用戶變為退出狀態。</li><li>通信失敗修正方法：<a href=http://faq.comsenz.com/viewnews-588 target=_blank>http://faq.comsenz.com/viewnews-588</a></li>',
	'nowuc_key' => '當前 UCenter 通信KEY',
	'nowconfig_authkey' => '當前論壇加密 KEY（配置文件）',
	'nowsetting_authkey' => '當前安全加密 KEY2（數據庫）',
	'nowmy_sitekey' => '當前漫遊平台 KEY',
	'nlocaluc' => '獲取不到 UCenter 配置文件，請手動重置應用管理中的通信 key<br/>',
	'resetauthkey' => '論壇安全密鑰已重置，將變成退出狀態<br/>',
	'mykeyerror' => '漫遊服務器無法鏈接到您的服務器<br/>',
	'changekey_update' => '系統安全KEY已經修改完畢，情況如下：<br/>',
	'template_php' => '搜索模板目錄的 php 文件',
	'attachment_php' => '搜索附件目錄的 php 文件',
	'static_php' => '搜索靜態文件目錄的 php 文件',
	'other_php' => '搜索其他目錄的 php 文件',
	'file_php_result' => '可疑文件搜索結果，請確認是否是自己的文件',
	'file_path' => 'php 文件服務器上的路徑',
	'file_hack' => '掃瞄惡意代碼',
	'nocheck' => '搜索結果為空',
	'file_hackresult' => '惡意代碼所在行數，請立即檢查刪除！',
	'file_phptip' => '<li>下面列出的目錄正常情況下都不會存在 php 文件，若存在，則有可能是後門程序</li><li>當附件目錄中文件較多的時候將會耗費更多時間</li>',
	'file_hacktip' => '<li>本功能不會搜索附件目錄與模板目錄中的文件，請先使用「可疑文件檢查」來檢索這些目錄中是否有PHP文件。</li><li>下面列出的是惡意代碼匹配的正則，直接點擊搜索即可。</li><li>所有搜索結果肯定為風險文件，請仔細檢查！以免對自己的站點造成損失！</li>',
	'replacetidtip' => '此功能將改變整站的主題 tid，如果您不知道此功能的作用，請不要使用，否則後果自負',
	'replacepidtip' => '此功能將改變整站的回復 pid，如果您不知道此功能的作用，請不要使用，否則後果自負',
	'file_hackupdate' => '更新掃瞄規則',
	'moudle_homedomain' => '二級域名配置',
	'moudle_domain' => '是否開啟家園二級域名',
	'moudle_root' => '二級域名根域名',
	'moudle_holddomain' => '保留的二級域名',
	'moudle_holddomaintip' => '所有綁定到其他模塊與專題的二級域名都需要填寫在這裡，逗號間隔，例如：www,home,forum',
	'motion_threadclick' => '修改某個帖子點擊數',
	'motion_allthreadclick' => '增加所有帖子點擊數',
	'motion_tid' => '需要修改的主題的 tid',
	'motion_views' => '需要修改為的點擊數',
	'motion_addviews' => '需要全局增加的點擊數',
	'motion_addviews_comment' => '過多帖子會消耗過多時間，謹慎操作！',
	'motion_error' => 'tid 與點擊數都必須為整數',
	'motion_hiserror' => '填寫的值需要為整數',
	'motion_emptytid' => '不存在這個tid',
	'motion_success' => '修改成功 ',
	'motion_hispost' => '修改今日發帖數',
	'motion_forumpost' => '版塊今日發帖數',
	'motion_forumfid' => '需要修改的版塊fid',
	'motion_nofid' => '不存在這個版塊',
	'moudle_cookiedomain' => 'cookie 作用域',
	'moudle_cookiedomaintip' => '如果開啟了多個模塊的二級域名，請設置這裡為根域名，不然將不能同步登陸退出<br/>如廣場域名為 bbs.comsenz.com 則這裡填寫 comsenz.com',
	'clearatt' => '<li>此功能將會掃瞄附件目錄中的附件，如果數據庫中不存在對應的附件則最後會給出列表是否進行刪除操作。</li><li>注意：附件過多將會消耗更多時間。</li>',
	'clearatt_lajiatt' => '選擇了的目錄中的冗余附件',
	'clearatt_nolaji' => '該目錄中不存在冗余附件，請檢查其他目錄',
	'clearatt_noselect' => '未選擇需要刪除的冗余附件',
	'move' => '搬家嚮導',
	'movedes' => '<h2>搬家嚮導</h2>
					<div style="font-size:12pt;">
					<ul>
					<li>本嚮導對搬家過程予以引導,搬家過程中要確保瀏覽器窗口運行狀態，以便參考。</li>
					<li>有些步驟是需要在新空間訪問本腳本的，具體見各個步驟文本說明。</li>
					<li>tools.php文件可以獨立運行於網站根目錄下，無需安裝tools工具。</li>
					<li>搬家前也應該先確定新空間運行環境是否符合原網站運行要求。</li>
					<li>搬家過程中注意對原網站數據的保護，避免不當操作帶來損失。</li>
					<li>為確保數據轉移的完整性，請您事先查看原論壇站點相關係統信息，如當前數據庫尺寸、當前附件尺寸等等，搬到新服務器空間後以便對照數據的大小完整度。</li>
					</ul></div>
					',
	'check' => '搬家嚮導 》選擇類型',
	'checkdes' => '請選擇您的服務器類型，點擊進入。',
	'backupwind' => '搬家嚮導 》Windows主機',
	'backupwinddes' =>  '<h2>第一步----停止MySQL</h2><br />
							<div style="width:400px; font-size:12pt;">
							必須停止MySQL服務。<br />
							開始 - 運行 - 輸入cmd - 回車<br />
							運行 net start |findstr /i my <br />
							查找自己MySQL服務名，一般情況下，都是mysql。
							在命令行窗口輸入：<br />
							net stop mysql <br />
							回車，停止MySQL服務。
							出現上圖所示，就可以點下一步了。
							</div>
							',
	'win2' => '搬家嚮導 》Windows主機',
	'win2des' => '<h2>第二步----打包MySQL數據</h2><br />
					<div style="width:400px; font-size:12pt;">
					進入MySQL所在目錄，打包',
	'win2dess' => '目錄為data.zip，
					打包文件時一定要在文件所在目錄全選，然後打包，不然直接打包data。
					解壓後會生成新一級data目錄。
					出現如右圖所示，就可以點下一步了。
					</div>',
	'win3' => '搬家嚮導 》Windows主機',
	'win3des' => '<h2>第三步----打包程序文件</h2><br />
				<div style="width:400px; font-size:12pt;">
					進入網站根目錄(',
	'win3dess' => ')，打包此目錄下的所有文件為web.zip。
					打包文件時一定要在文件所在目錄全選，然後壓縮打包，不然直接打包web文件夾，解壓後會生成新一級web目錄。
					按圖操作，點確定，壓縮完就可以點下一步了。
					</div>',
	'win4' => '搬家嚮導 》Windows主機',
	'win4des' => '<h2>第四步----移動打包文件</h2><br />
					<div style="width:400px; font-size:12pt;">
					把剛才打包好的兩個備份包全部移動到網站根目錄下（',
	'clearatt_done' => '已經刪除選擇的冗余附件',
	'ver_has' => '當前版本已經內置此功能，請到對應位置設置',
	'convert_scharset' => '點擊提交將進行編碼轉換（反覆提交將清空之前轉換了的數據）',
	'win4dess' => '）
						出現如右圖所示，就可以點下一步了。
						</div>',
	'win5' => '搬家嚮導 》Windows主機',
	'win5des' => '<h2>第五步----測試壓縮包位置</h2><br />
					<div style="width:400px; font-size:12pt;">
						在瀏覽器中測試上一步中放置好的備份包能否被訪問到。
						打開瀏覽器頁面，輸入網站的網址測試：<br />（http://www.aaa.com/）為您站點地址。<br />
						測試數據庫備份包訪問地址：http://www.aaa.com/data.zip<br />
						測試網站文件備份包訪問地址：http://www.aaa.com/web.zip<br />
						如果都能正常彈出下載窗口，說明文件已經能正常訪問並可以下載。<br />
						我們在原服務器上的備份工作就已經完成了。
						</div>',
	'win6' => '搬家嚮導 》Windows主機',
	'win6des' => '<h2>第六步----下載數據庫壓縮包到新空間</h2><br />
					<div style="width:400px; font-size:12pt;">
						<b>注意：以下步驟需在新空間完成。</b><br />
						下載原服務器數據庫備份包到新服務器。<br />
						如右圖操作，指定好下載位置，下載完畢，就可以點下一步了。
						</div>',
	'win7' => '搬家嚮導 》Windows主機',
	'win7des' => '<h2>第七步----解壓文件</h2><br />
					<div style="width:400px; font-size:12pt;">
						下載後得到data.zip文件，接下來要解壓此備份包。<br />
						解壓完畢後得到data目錄，這個目錄就是網站的數據庫，數據庫名就是data。<br />
						按圖操作，解壓完畢後，就可以點下一步了。
						</div>',
	'win8' => '搬家嚮導 》Windows主機',
	'win8des' => '<h2>第八步----重啟MySQL服務</h2><br />
					<div style="width:400px; font-size:12pt;">
						解壓後的數據庫暫時還不能使用，需要重新啟動MySQL服務才能完全生效。<br />
						停止MySQL的命令為:net stop mysl<br />
						開啟MySQL的命令為:net start mysql<br />這個MySQL服務名和第一步獲取的方式一樣。
						重啟完畢後數據庫即可使用，需要用新服務器上MySQL的root權限登錄調用，其他權限自行設置。<br />
						出現如上圖所示，就可以點下一步了。
						</div>',
	'win9' => '搬家嚮導 》Windows主機',
	'win9des' => '<h2>第九步----下載程序文件壓縮包</h2><br />
					<div style="width:400px; font-size:12pt;">
						進入新服務器的網站根目錄，下載原服務器上的原文件備份包到新服務器。<br />
						按圖操作，指定好下載位置，下載完畢，就可以點下一步了。
						</div>',
	'win10' => '搬家嚮導 》Windows主機',
	'win10des' => '<h2>第十步----解壓web壓縮包</h2><br />
					<div style="width:400px; font-size:12pt;">
						下載完成後，得到web.zip文件，接下來要解壓此備份包。<br />
						解壓完畢後，就算基本完成了數據的恢復。<br />
						在IIS裡指定站點的根目錄到web目錄下，就可以點下一步了。
						</div>',
	'win11' => '搬家嚮導 》Windows主機',
	'win11des' => '<h2>第十一步----綁定IP</h2>
					<div style=" font-size:12pt;">
						<b>注意：本步驟必須在新空間執行。</b><br />
						設置好新服務器數據庫帳號密碼之前，可以解析域名到新服務器的IP，或者修改本地hosts文件綁定域名。<br />
						這裡強調域名問題，旨在本步驟操作完成後，需要更新緩存，涉及到緩存路徑的問題。<br />
						hosts文件具體修改方法可以參考：<a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高對經常訪問的網絡域名的解析效率</u></a><br /> 
						綁定完域名後便可以訪問自己的新站點。
						</div>',
	'win12' => '搬家嚮導 》Windows主機',
	'win12des' => '<h2>第十二步----修改數據庫帳號密碼</h2>',
	'win13' => '搬家嚮導 》Windows主機',
	'win13des' => '<h2>第十三步----修改數據庫帳號密碼</h2>',
	'win14' => '搬家嚮導 》Windows主機',
	'win14des' => '<h2>第十四步----更新緩存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完數據庫帳號，下一步就是更新緩存了。<br />
						點擊',
	'win14dess' => '按鈕，會新開一個頁面,執行更新緩存，待更新緩存完畢後，回到本引導頁面進入下一步。
						</div>',
	'win15' => '搬家嚮導 》Windows主機',
	'win15des' => '<h2>第十五步----打開站點</h2>
				<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'win16' => '搬家嚮導 》Windows主機',
	'win16des' => '<h2>最後一步----瀏覽站點</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'backuplinux' => '搬家嚮導 》Linux主機',
	'backuplinuxdes' => '<h2>第一步----停止MySQL服務</h2><br />
						<div style=" font-size:12pt;">
							必須停止MySQL服務。<br />
							執行ll /etc/init.d/ |grep my 得到MySQL服務名。<br />
							在命令行窗口輸入service mysqld stop 回車（mysqld為查找到的MySQL服務名）。<br />
							出現如右圖所示，就可以點下一步了。
							</div>',
	'lin2' => '搬家嚮導 》Linux主機',
	'lin2des' => '<h2>第二步----打包MySQL數據</h2><br />
					<div style=" font-size:12pt;">
						進入MySQL所在目錄，打包（',
	'lin2dess' => '）目錄下文件為data.tar.gz。 <br />
						打包命令為：tar zcvf data.tar.gz data<br />
						打包文件時一定要在文件所在目錄全選，然後打包，不然直接打包data，
						解壓後會生成新一級data目錄。
						出現如上圖所示，就可以點下一步了。
						</div>',
	'lin3' => '搬家嚮導 》Linux主機',
	'lin3des' => '<h2>第三步----打包程序文件</h2><br />
					<div style=" font-size:12pt;">
						進入網站根目錄',
	'lin3dess' => '，打包此目錄下的文件為web.tar.gz<vr />
						打包命令為：<br />tar zcvf web.tar.gz *<br />
						打包文件時一定要在文件所在目錄全選，然後打包，不然直接打包根目錄，
						解壓後會生成新一級根目錄名。
						出現如上圖所示，就可以點下一步了。
						</div>',
	'lin4' => '搬家嚮導 》Linux主機',
	'lin4des' => '<h2>第四步----移動MySQL備份壓縮包</h2><br />
					<div style=" font-size:12pt;">
						把剛才打包好的兩個備份包全部移動到網站根目錄下。<br />
						移動的命令為：<br />mv ',
	'convert_dbbase' => '將轉換的數據庫',
	'convert_curcharset' => '當前數據庫編碼',
	'convert_tocharset' => '將要轉換到的編碼',
	'convert_serilise' => '數據編碼轉換完畢，修復序列化數據。',
	'convert_count' => '所有的表創建完成，數據庫共有 {count} 個表！',
	'convert_converting' => '正在轉移 {table} 表的從 {start} 條記錄開始的後 {limit} 條記錄',
	'convert_done' => '轉換成功，轉換後的表前綴為 {todbcharset}_pre_ 請自行修改 配置文件中對應的編碼與數據庫前綴',
	'lin4dess' => 'web.tar.gz ',
	'lin4desss' => 'mv ',
	'lin4desbb' =>'data.tar.gz ',
	'lin4desbbb' => '<br /><img src="source/plugin/tools/template/image/lin/4.jpg"><br />
						出現如上圖所示，就可以點下一步了。
						</div>',
	'lin5' => '搬家嚮導 》Linux主機',
	'lin5des' => '<h2>第五步----測試壓縮包位置</h2><br />
					<div style=" font-size:12pt;">
						用瀏覽器測試上一步中放置好的備份包能否被訪問。<br />
						打開瀏覽器頁面，輸入網站的網址測試：<br />
						http://www.aaa.com/為您站點地址。<br />
						測試數據庫備份包訪問地址：http://www.aaa.com/data.tar.gz<br />
						測試網站文件備份包訪問地址：http://www.aaa.com/web.tar.gz<br />
						如果都能正常彈出下載窗口，說明文件已經能正常訪問並可以下載。<br />
						我們在原服務器上的備份工作就已經完成了。<br />
						</div>',
	'lin6' => '搬家嚮導 》Linux主機',
	'lin6des' => '<h2>第六步----下載MySQL壓縮包</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：以下步驟需要在新空間完成。</b><br />
						進入MySQL的data目錄，下載原服務器上的數據庫備份包到新服務器。<br />
						下載命令為：<br />wget http://www.aaa.com/data.tar.gz<br />
						www.aaa.com/為你原站點域名。<br />
						按照右圖所示操作後，就可以點下一步了。
						</div>',
	'lin7' => '搬家嚮導 》Linux主機',
	'lin7des' => '<h2>第七步----解壓MySQL壓縮包</h2><br />
					<div style=" font-size:12pt;">	
						下載完data.tar.gz文件，接下來要解壓此備份包。<br />
						解壓命令為：<br />tar zxvf data.tar.gz<br />
						解壓完畢後得到data目錄，這個目錄就是網站的數據庫。<br />
						出現如上圖所示，就可以點下一步了。
						</div>',
	'lin8' => '搬家嚮導 》Linux主機',
	'lin8des' => '<h2>第八步----重啟MySQL服務</h2><br />
					<div style=" font-size:12pt;">
						解壓後數據庫暫時不能使用，需要重新啟動MySQL服務才能生效。
						重啟MySQL的命令為：<br />service mysqld restart<br />
						重啟完畢後數據庫即可使用，需要用新服務器上MySQL的root權限登錄調用，其他權限自行設置。<br />
						出現如右圖所示，就可以點下一步了。
						</div>',
	'lin9' => '搬家嚮導 》Linux主機',
	'lin9des' => '<h2>第九步----下載原站點文件壓縮包</h2><br />
					<div style=" font-size:12pt;">
						進入新服務器的網站根目錄，下載原服務器上的備份包到新服務器
						下載命令為：<br />wget http://www.aaa.com/web.tar.gz<br />
						出現如右圖所示，就可以點下一步了。
						</div>',
	'lin10' => '搬家嚮導 》Linux主機',
	'lin10des' => '<h2>第十步----解壓縮原站點文件壓縮包</h2><br />
					<div style=" font-size:12pt;">
						下載完成後，得到web.tar.gz文件，接下來要解壓此備份包。<br />
						解壓命令為：tar zxvf web.tar.gz<br />
						解壓完畢後，就算基本完成了數據的恢復<br />
						出現如上圖所示，就可以點下一步了。
						</div>',
	'lin11' => '搬家嚮導 》Linux主機',
	'lin11des' => '<h2>第十一步----更改數據庫帳號密碼</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：本步驟必須在新空間執行。</b><br />
						設置好新服務器數據庫帳號密碼之前，可以解析域名到新服務器的IP，或者修改本地hosts文件綁定域名。<br />
						這裡強調域名問題，旨在本步驟操作完成後，需要更新緩存，涉及到緩存路徑的問題。<br />
						hosts文件具體修改方法可以參考：<a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高對經常訪問的網絡域名的解析效率</u></a><br /> 
						綁定完域名後便可以訪問自己的新站點。
						</div>',
	'lin12' => '搬家嚮導 》Linux主機',
	'lin12des' => '<h2>第十二步----修改數據庫帳號密碼</h2>',
	'lin13' => '搬家嚮導 》Linux主機',
	'lin13des' => '<h2>第十三步----修改數據庫帳號密碼</h2>',
	'lin14' => '搬家嚮導 》Linux主機',
	'lin14des' => '<h2>第十四步----更新緩存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完數據庫帳號，下一步就是更新緩存了。<br />
						點擊',
	'lin14dess' => '按鈕，會新開一個頁面,執行更新緩存，待更新緩存完畢後，回到本引導頁面進入下一步。
						</div>',
	'lin15' => '搬家嚮導 》Linux主機',
	'lin15des' => '<h2第十五步----打開站點</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'lin16' => '搬家嚮導 》Linux主機',
	'lin16des' => '<h2>最後一步----瀏覽站點</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'backupxn' => '搬家嚮導 》虛擬主機',
	'backupxndes' => '<h2>第一步----簡要概述</h2><br /><br />
					<div style=" font-size:12pt;">
							虛擬主機備份文件的方法很單一，只有兩種辦法：<br />
							1.在主機面板打包或要求主機商打包，下載備份包到本地。<br />
							2.直接用FTP把所有網站根目錄下的文件下載到本地。<br />
							恢復的方法也很單一，還是兩種辦法：<br />
							1.上傳備份包到虛擬主機上，在面板解包恢復或者要求主機商解包恢復。<br />
							2.直接用FTP把所有網站根目錄下的文件上傳到新空間的網站根目錄。
							下面就去關閉站點，備份數據庫。<br />
							如果已經把所有文件都移動到了新空間，那麼可以點擊',
	'house_export' => '備份房產數據',
	'backupxndess' => '按鈕。
						</div>',
	'xn3' => '搬家嚮導 》虛擬主機',
	'xn3des' => '<h2>第三步----備份數據庫</h2><br />
					<div style=" font-size:12pt;">
						關閉論壇後，就可以備份數據庫了。<br />
						點擊下面的鏈接去備份數據庫，下面的鏈接會在新標籤頁打開，請確保本頁面運行。<br />
						備份數據庫需要注意的是，如果UCenter和論壇是在同一個數據庫中，則可按照默認方式備份數據。<br />
						如果UCenter和論壇不在同一個數據庫，那麼需要單獨備份UCenter。<br />
						點擊',
	'xn3dess' =>'按鈕，會打開新窗口，本窗口不要關閉。備份完畢後，再回到本引導窗口。<br />備份完數據庫就可以進入下一步操作。<br />
						</div>',
	'xn4' => '搬家嚮導 》虛擬主機',
	'xn4des' => '<h2>第四步----壓縮文件</h2><br />
					<div style=" font-size:12pt;">
						到控制面板打包文件並下載，一般情況下虛擬主機都會有在線壓縮、解壓文件功能，具體見右圖。<br />
						壓縮後生成的文件名一般都是可以自己定義的，也有些是以系統時間命名的；<br />壓縮時，要從根目錄文件
						處壓縮，因為如果在頂級目錄壓縮，解壓時會多產生一層目錄。<br />
						壓縮打包好後，可以用FTP工具下載了，如果空間不支持文件壓縮，可以直接用FTP軟件直接下載文件到本地。
						</div>',
	'xn5' => '搬家嚮導 》虛擬主機',
	'xn5des' => '<h2>第五步----上傳壓縮包</h2><br />
					<div style=" font-size:12pt;">
						上傳原站點文件壓縮包到新空間，一般虛擬空間根目錄文件名稱為wwwroot或httpdocs，也有是直接根目錄的。
						沒壓縮功能的，只能通過ftp上傳文件到新空間。
						</div>',
	'xn6' => '搬家嚮導 》虛擬主機',
	'xn6des' => '<h2>第六步----解壓壓縮包</h2><br />
				<div style=" font-size:12pt;">
					解壓壓縮包到新空間根目錄。 <br />
					解壓縮與壓縮功能一般在空間控制面板的同一處。 <br />
					此時注意解壓後的文件所處位置，是否正確。 <br />
					這個類似於wwwroot的目錄，是指綁定了域名或ip後的目錄。 <br />
					修改完配置文件後，就可以登錄網站後台，更新緩存了。 <br />
					下一步就是去更新配置文件中的數據庫帳號密碼。<br />
					<b>注意：以下步驟必須在新空間完成，即在新空間訪問tools.php文件</b><br />
					</div>',
	'xn7' => '搬家嚮導 》虛擬主機',
	'xn7des' => '<h2>第八步----修改數據庫帳號密碼</h2>',
	'xn8' => '搬家嚮導 》虛擬主機',
	'xn8des' => '<h2>第九步----修改數據庫帳號密碼</h2>',
	'xn9' => '搬家嚮導 》虛擬主機',
	'xn9des' => '<h2>第十步----恢復數據庫</h2><br /><br />
					<div style=" font-size:12pt;">
						修改好數據庫帳號後，確定域名已經處理完畢，就可以恢復數據庫了，點擊',
	'xn9dess' => '按鈕，會跳到新頁面執行恢復數據，執行完畢再回到本引導頁。<br />
				如果執行完了數據庫恢復，請點擊下一步。		</div>',
	'xn10' => '搬家嚮導 》虛擬主機',
	'xn10des' => '<h2>第十一步----更新緩存</h2><br /><br />
						<div style=" font-size:12pt;">
						解析好域名，修改完數據庫帳號，恢復完數據庫，下一步就是更新緩存了。<br />
						點擊',
	'xn10dess' => '按鈕，會新開一個頁面,執行更新緩存，待更新緩存完畢後，回到本引導頁面進入下一步。
						</div>',
	'xn11' => '搬家嚮導 》虛擬主機',
	'xn11des' => '<h2>第十二步----打開站點</h2>
				<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'xn12' => '搬家嚮導 》虛擬主機',
	'xn12des' => '<h2>最後一步----瀏覽站點</h2>
					<div style=" font-size:12pt;">
					前期的工作都做完後，就可以打開新站點了。<br />
					打開新站點後可以參照之前原站點數據庫大小和文件附件大小，比對新站點。
					</div>',
	'xn13' => '搬家嚮導 》虛擬主機',
	'xn13des' => '<h2>第七步----綁定域名</h2><br />
					<div style=" font-size:12pt;">
						<b>注意：從本步驟起，必須在新空間執行。</b><br />
						設置好新服務器數據庫帳號密碼之前，可以解析域名到新服務器的IP，或者修改本地hosts文件綁定域名。<br />
						這裡強調域名問題，旨在本步驟操作完成後，需要更新緩存，涉及到緩存路徑的問題。<br />
						hosts文件具體修改方法可以參考： <br /><a href="http://www.discuz.net/thread-2240032-1-1.html" target="_blank"><u>利用修改hosts文件提高對經常訪問的網絡域名的解析效率</u></a><br /> 
						綁定完域名後便可以訪問自己的新站點。
						</div>',
	'noclosed' => '站點未關閉，請關閉站點，再進行下一步',
	'clearmodereter' => '清理審核冗餘數據',
	'clearmodereter_suc' => '清理審核冗餘數據完成',
	'ucdbnames' => 'UCenter數據庫名錯誤，請返回。',
	'bbsdbnames' => '論壇數據庫名錯誤，請返回。',
	'uchost' => 'UCenter數據庫帳號錯誤，請返回。',
	'bbshost' => '論壇數據庫帳號錯誤，請返回。',
);

$templatelang['tools'] = array(
	'nowadminer' => '現有管理員（副站長）：',
	'nowfounder' => '現有創始人',
	'username' => '用戶名',
	'passwordtip' => '請輸入密碼',
	'issecquesreset' => '是否清除安全提問',
	'yes' => '是',
	'no' => '否',
	'submit' => '提交',
	'sitestatu' => '站點當前狀態',
	'open' => '打開',
	'close' => '關閉',
	'closereason' => '關閉理由',
	'updatedata' => '更新數據緩存',
	'updatetemplates' => '更新模板緩存',
	'updatedatatip' => '模板顯示錯位問題請更新模板緩存',
	'updatetemplatestip' => '站點無法打開，或者設置未生效，可以嘗試更新數據緩存',
	'sitedbstatu' => '站點數據庫連接',
	'sitedbext' => '站點數據庫',
	'ucapi' => 'UCenter 地址：',
	'ucdbstatu' => 'UCenter 數據庫連接',
	'ucdbext' => 'UCenter 數據庫',
	'ext' => '<span class=green>存在</span>',
	'noext' => '<span class=red>不存在</span>',
	'right' => '<span class=green>正常</span>',
	'failed' => '<span class=red>失敗</span>',
	'dbhost' => 'Mysql 地址：',
	'dbuser' => 'Mysql 賬號：',
	'dbpw' => 'Mysql 密碼：',
	'dbname' => '站點數據庫名稱：',
	'dbpre' => '站點數據庫表前綴：',
	'ucdbhost' => 'UCenter 數據庫地址：',
	'ucdbuser' => 'UCenter 數據庫賬號：',
	'ucdbpw' => 'UCenter 數據庫密碼：',
	'ucdbname' => 'UCenter 數據庫名稱：',
	'ucdbpre' => 'UCenter 數據庫表前綴：',
	'ucip' => 'UCenter IP：',
	'password' => '密碼：',
	'nopassword' => '未設置 Tools 密碼，請設置密碼後訪問。',
	'toolswelcome' => '歡迎使用 Tools 工具外部接口，請從右側選擇需要設置的項目。',
	'suggest' => '對 Tools 有更好的意見與建議，請反饋到官方論壇。',
	'gotodiscuz' => '跳轉到 Discuz! 官方論壇',
	'secodestatu' => '當前驗證碼狀態',
	'closesecode' => '關閉驗證碼',
	'nosecode' => '提示：當前站點未啟用驗證碼。',
	'havesecode' => '提示：當前站點使用了驗證碼。',
	'tablename' => '表名',
	'tablesize' => '大小',
	'allcheck' => '全部檢查',
	'allrepair' => '全部修復',
	'check' => '檢查',
	'repair' => '修復',
	'baktiem' => '備份項目',
	'version' => '版本',
	'time' => '時間',
	'type' => '類型',
	'total' => '文件總數',
	'import' => '導入',
	'authtypeb' => '當前驗證模式為安全模式，密碼為在站點後台插件面板中設置的密碼。<br/>當前後台可以啟用密鑰驗證',
	'authtypea' => '當前驗證模式為臨時模式，密碼為 tools.php 文件中的設置的密碼。請在使用後修改。',
	'mback' => '上一步',
	'mnext' => '下一步',
	'startm' => '開始搬家',
	'win' => 'Windows主機搬家',
	'lin' => 'Linux主機搬家',
	'xn' => '虛擬主機搬家',
	'newconfig' => '下一步，更改配置文件',
	'dbusername' => '數據庫用戶名',
	'mdbpw' => '數據庫密碼',
	'mdbname' => '數據庫名',
	'mupdatechache' => '更新緩存',
	'mopensite' => '打開站點',
	'viewsite' => '瀏覽站點',
	'innew' => '我已經到新空間了',
	'nextclose' => '下一步，關閉站點',
	'backupdb' => '數據庫備份',
	'overdb' => '數據庫備份完畢，下一步',
	'uploadzip' => '已上傳壓縮包，下一步',
	'downzip' => '已下載壓縮包，下一步',
	'ipdns' => '下一步，綁定域名',
);

$installlang['tools'] = array(
	'menu_exttools_pw' => '密碼設置',
	'menu_exttools_moudle' => '模塊相關設置',
	'menu_exttools_cleardb' => '清理數據庫冗余',
	'menu_exttools_exportdata' => '導出個人信息',
	'menu_exttools_district' => '地區備份/恢復',
	'menu_exttools_censor' => '敏感詞管理',
	'menu_exttools_ucenter' => 'UCenter相關',
	'menu_exttools_safe' => '安全工具',
	'menu_exttools_motion' => '運營工具',
	'menu_exttools_att' => '附件清理',
	'menu_exttools_convert' => '編碼轉換',
	'menu_exttools_house' => '房產備份',
);

?>