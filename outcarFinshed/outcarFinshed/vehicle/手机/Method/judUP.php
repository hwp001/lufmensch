<?php
class Verify{   
/**
 * 验证用户名
 * @param string $value
 * @param int $length
 * @return boolean
 */
    public static function isNames($value, $minLen=2, $maxLen=10, $charset='ALL'){
        if(empty($value))
            return false;
        switch($charset){
            case 'EN': $match = '/^[_\w\d]{'.$minLen.','.$maxLen.'}$/iu';
                break;
            case 'CN':$match = '/^[_\x{4e00}-\x{9fa5}\d]{'.$minLen.','.$maxLen.'}$/iu';
                break;
            default:$match = '/^[_\w\d\x{4e00}-\x{9fa5}]{'.$minLen.','.$maxLen.'}$/iu';
        }
        return preg_match($match,$value);
    }

    /**
     * 验证密码
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isPWD($value,$minLen=5,$maxLen=18){
        $match='/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{'.$minLen.','.$maxLen.'}$/';
        $v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
    }

    /**
     * 验证eamil
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isEmail($value,$match='/^[\w\d]+[\w\d-.]*@[\w\d-.]+\.[\w\d]{2,10}$/i'){
        $v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
    }

    /**
     * 验证电话号码
     * @param string $value
     * @return boolean
     */
    public static function isTelephone($value,$match='/^0[0-9]{2,3}[-]?\d{7,8}$/'){
        $v = trim($value);
        if(empty($v)) 
            return false;
        return preg_match($match,$v);
    }

    /**
     * 验证手机
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isMobile($value,$match='/^[(86)|0]?(13\d{9})|(15\d{9})|(18\d{9})$/'){
        $v = trim($value);
        if(empty($v)) 
            return false;        #
        if (strlen($v) > 11) {
            return false;
        }

        return preg_match($match,$v);
    }

   /*
    验证真实姓名
    */
    public static function isTrueName($value){
        if(empty($value))
         return false;
        $len = strlen($value);
        if (strlen($value)<=0) {
            return false;
        }

         for ($i=0; $i <strlen($value); $i++) { 
             $str = substr($value, $i,$i+1);
             if (ord($str)<127) {
                 return false;
             }
         }
         return true;
    }

   /*
    验证角色名
    */
    public static function isRoleName($value){
        if(empty($value))
         return false;
        $len = strlen($value);
        if (strlen($value)<=0) {
            return false;
        }
         for ($i=0; $i <strlen($value); $i++) { 
             $str = substr($value, $i,$i+1);
             if (ord($str)<127) {
                 return false;
             }
         }
         return true;
    }



}
?>