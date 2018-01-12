<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class ThreadClass
{
    function getClasses()
    {
        return array(
            1 => array(
                'name' => '»§ÍâÆ·ÅÆ',
                'template' => 'brand',
                'fields' => array(
                    'zhaoshang' => '',
                ),
            ),
        );
    }
    
    function getFields($class_id)
    {
        $classes = self::getClasses();
        if (!empty($classes[$class_id])) {
            return $classes[$class_id]['fields'];
        }
        return array();
    }
    
    function getTemplate($class_id)
    {
        $classes = self::getClasses();
        if (!empty($classes[$class_id])) {
            return $classes[$class_id]['template'];
        }
        return array();
    }
}