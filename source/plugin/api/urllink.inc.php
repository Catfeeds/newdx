<?php

if ($_POST['url']) {
    
    $json = array(
        'error_code' => 0,
        'url' => ''
    );
    
    if (preg_match('/^https?:\/\/([^\/?#]+)/i', $_POST['url'], $match)) {
        $host = $match[0];
        if (preg_match('/(.*?)(.(com|net|org|gov|edu|mil|biz|name|info|mobi|pro|travel|museum|int|areo|post|rec|asia)(.(ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cf|cd|ch|ci|ck|cl|cm|cn|co|cq|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|ev|fi|fj|fk|fm|fo|fr|ga|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|jm|jo|jp|je|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|qa|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pt|pw|py|re|rs|ro|ru|rw|sa|sd|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|su|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|za|zm|zw))?)/i', $match[1], $match)) {
            if (($pos = strrpos($match[1], '.')) !== false) {
                $suffix_domian = substr($match[1], $pos + 1).$match[2]; // eg: baidu.com
            } else {
                $suffix_domian = $match[0];
            }
        }
    }

    if (preg_match('/^.*\//i', $_POST['url'], $match)) {
        $pre_path = $match[0];
    }

    $content = file_get_contents($_POST['url']);
    if ($content) {
        $url_list = array();
        if (preg_match_all('/<a .*?href=(?:[\'"]?| *)(.*?)[\'" >]/i', $content, $matches)) {
            foreach ($matches[1] as $url) {
                if (stripos($url, $suffix_domian) !== false && preg_match('/^https?:\/\//i', $url)) {
                    $url_list[] = $url;
                } elseif (preg_match('/^\//', $url)) {
                    $url_list[] = $host.$url;
                } elseif (!preg_match('/^https?:\/\/|javascript:|#/i', $url)) {
                    $url_list[] = $pre_path.$url;
                }
            }

            if ($url_list) {
                $index = rand(0, count($url_list) - 1);
                $json['url'] = $url_list[$index];
                echo json_encode($json);
                exit;
            }
        }
    }
}

$json['error_code'] = 1;
echo json_encode($json);