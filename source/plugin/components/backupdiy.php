<?php

function backupdiy($tpl) {
    require_once libfile('function/portalcp');
    tpl_checkperm($tpl);
    
    list($tpl,$id) = explode(':', $tpl);
    $tplname = $id ? $tpl.'_'.$id : $tpl;
    $diydata = DB::fetch_first('SELECT * FROM '.DB::table('common_diy_data')." WHERE targettplname='$tplname'");
    if (empty($diydata) && $id) $diydata = DB::fetch_first('SELECT * FROM '.DB::table('common_diy_data')." WHERE targettplname='$tpl'");
    if ($diydata) {

        $filename = $diydata['targettplname'];

        $diycontent = unserialize($diydata['diycontent']);

        if (empty($diycontent)) return;

        foreach ($diycontent['layoutdata'] as $key => $value) {
            if (!empty($value)) getframeblock($value);
        }

        $diycontent['blockdata'] = block_export($_G['curtplbid']);

        require_once libfile('class/xml');
        $str = array2xml($diycontent, true);
        
        $filename = str_replace("/", "_", $tpl);
        $filename .= $id ? "_$id" : '';
        $filename .= "_" . date('Ymd_His');
        if (!file_exists(DISCUZ_ROOT."/data/backupdiy/")) {
            mkdir(DISCUZ_ROOT."/data/backupdiy/", 0755);
        }
        file_put_contents(DISCUZ_ROOT."/data/backupdiy/{$filename}.xml", $str);
    }
}
