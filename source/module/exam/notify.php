<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Api.php";
require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Notify.php";


class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id, $cash_fee, $attach,$trade_type)
	{
        global $_G;
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
            $tmp = explode('-',$attach);
            $data = array();
            $data['uid'] = $tmp[1];
            $data['transaction_id'] = $transaction_id;
            $data['cash_fee'] = $cash_fee;
            $data['create_time'] = time();
            if($tmp[0] == 2){
                $data['pay_id'] = $tmp[2];
                $data['type'] = 2;
            }
            if($trade_type == 'JSAPI'){     //公众号支付
                $data['trade_type'] = 1;
            }elseif($trade_type == 'NATIVE'){   //扫码支付
                $data['trade_type'] = 2;
            }
            DB::insert('exam_pay_record', $data);
            if(DB::insert_id()){
                $vip_begin = strtotime(date('Y-m-d',$data['create_time']));
                $vip_end = strtotime("+1 year",$vip_begin);
                DB::update('common_member_connect_wechat', array('vip_begin' => $vip_begin, 'vip_end' => $vip_end), "uid='{$tmp[1]}'");
                return true;
            }else{
                $logs_msg = "exam_pay|{$tmp[1]}|".var_export($data, true);
                require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
                $logs = new logs('exam_pay_callback');
                $logs->log_str($logs_msg);
                return false;
            }
		}else{
            $logs_msg = "exam_pay|{$transaction_id}|".var_export($result, true);
            require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
            $logs = new logs('exam_pay_callback');
            $logs->log_str($logs_msg);
        }
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"], $data['cash_fee'], $data['attach'],$data['trade_type'])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}
