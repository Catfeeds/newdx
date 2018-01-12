<?php
$rand = rand(1,10);
$testData = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_test')." order by viewstop asc limit {$rand}, 1");
$str = <<<END
<iframe width="0" height="0" frameborder="0" src="http://{$_G['setting']['domain']['app']['forum']}{$testData['url']}" style="height:0;font-size:0;"></iframe>
END;
echo $str;