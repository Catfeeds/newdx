<?php
/**
 * Created by PhpStorm.
 * User: Lgt
 * Date: 14-10-14
 * Time: 上午9:12
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

Class Foreign_countryModel extends BaseModel
{
    var $table = 'plugin_foreign_country';
    var $alias = 'p_f_c';
    var $prikey = 'country_id';


    function insert_foreign_country($country_name)
    {
        $where = "country_name = '$country_name'";
        $foreign_country = $this->get(array('conditions' => $where, 'limit' => '0,1'));
        if (!empty($foreign_country)) {
            return $foreign_country['country_id'];
        } else {
            $country_id = $this->add(array('country_name' => $country_name, 'postdate' => time()));
            if ($country_id) {
                return $country_id;
            } else {
                return null;
            }
        }
    }

    /*此函数已经抽离到class下的点评公共类Countries中*/
    function get_foreign($first_alias = '', $second_alias = '')
    {
        if ($first_alias && $second_alias) {
            return $this->find(array(
                'fields' => "country_id as {$first_alias},country_name as {$second_alias}"
            ));
        } else {
            return $this->find(array(
                'fields' => "country_id ,country_name "
            ));
        }
    }


}