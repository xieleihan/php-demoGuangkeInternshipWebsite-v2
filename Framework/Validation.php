<?php

namespace Framework;

class Validation{

    /**
     * 验证长度要求
     * 
     * @param string $value
     * @param integer $min
     * @param int $max
     * @return bool
     */
    public static function string($value,$min=1,$max=INF){
        if(is_string($value)){
            $value = trim($value);
            $length= strlen($value);
            return $length >= $min && $length <=$max;
        }

        return false;
    }

    /**
     * 验证电子邮件地址
     * 
     * @param string $value
     * @return mixed
     */
    public static function email($value)
    {
        $value = trim($value);
        return filter_var($value,FILTER_VALIDATE_EMAIL);
    }

    /**
     * 比较两个值是否相等
     * 
     * @param string $value1
     * @param string $value2
     * @return bool
     */
    public static function match($value1,$value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }
}