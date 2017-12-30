<?php

include_once dirname(__FILE__) . '/../Validation_Interface.php';
include_once dirname(__FILE__) . '/Validation_Condition.php';

class Validation_Type implements Validation_Interface
{
    private static $indicator = 'is';

    public static function getIndicator()
    {
        return self::$indicator;
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return boolean  [[Description]]
     */
    public static function validate_is_float($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        
        if (is_array($input[$key])){
            return false;
        }

        if (is_float($input[$key]) || is_int($input[$key])) {
            return;
        }
        
        if (!is_string($input[$key])){
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^\d+\.\d+$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return boolean  [[Description]]
     */
    public static function validate_is_boolean($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        
        if (!is_bool($input[$key])){
            return false;
        }

        return;
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return boolean  [[Description]]
     */
    public static function validate_is_integer($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        if (is_int($input[$key])) {
            return;
        }
        if (is_string($input[$key]) && !ctype_digit($input[$key])) {
            return false; // contains non digit characters
        }
        if (!is_int((int) $input[$key])) {
            return false; // other non-integer value or exceeds PHP_MAX_INT
        }
        if (is_string($input[$key]) && ctype_digit($input[$key])) {
            return; // es sind nur Ziffern
        }

        return false;
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return boolean  [[Description]]
     */
    public static function validate_is_string($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (is_string($input[$key])) {
            return;
        }

        return false;
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return boolean  [[Description]]
     */
    public static function validate_is_array($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key])) {
            return;
        }

        if (is_array($input[$key])) {
            return;
        }

        return false;
    }
}
