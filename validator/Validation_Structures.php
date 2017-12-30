<?php

include_once dirname(__FILE__) . '/../Validation_Interface.php';

class Validation_Structures implements Validation_Interface
{
    public static $indicator = 'to';

    public static function getIndicator()
    {
        return self::$indicator;
    }

    public static function validate_to_structure($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($input[$key])) {
            return array('valid'=>true,'field'=>$key,'value'=>null);
        }

        if (!isset($param)) {
            throw new Exception('Validation rule \''.__METHOD__.'\', missing parameter.');
        }

        $method = $param.'::decode'.$param;
        $obj = @$method($input[$key]);

        if ($obj === null) {
            return false;
        }

        return array('valid'=>true,'field'=>$key,'value'=>$obj);
    }
}
