<?php

include_once dirname(__FILE__) . '/../Validation_Interface.php';
include_once dirname(__FILE__) . '/Validation_Condition.php';

class Validation_Structure implements Validation_Interface
{
    private static $indicator = 'valid';

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
    public static function validate_valid_email($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (!filter_var($input[$key], FILTER_VALIDATE_EMAIL)) {
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
    public static function validate_valid_url($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        
        if (!is_string($input[$key])){
            return false;
        }

        if (parse_url($input[$key]) === false) {
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
    public static function validate_valid_url_query($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        
        if (!is_string($input[$key])){
            return false;
        }

        $var = parse_url($input[$key]);

        if ($var === false) {
            return false;
        }

        if (isset($var['path'])) {
            unset($var['path']);
        }
        if (isset($var['query'])) {
            unset($var['query']);
        }

        if (!empty($var)) {
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '/^[a-zA-Z0-9+&@#\/%?=~_|!:,.;]*[a-zA-Z0-9+&@#\/%=~_|]$/i');
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
    public static function validate_valid_regex($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (@preg_match($input[$key], null) === false) {
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
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_hash($key, $input, $setting = null, $param = null)
    {
        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([a-fA-F0-9]+)$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_md5($key, $input, $setting = null, $param = null)
    {
        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^[0-9A-Fa-f]{32}$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_sha1($key, $input, $setting = null, $param = null)
    {
        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^[0-9A-Fa-f]{40}$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_identifier($key, $input, $setting = null, $param = null)
    {
        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([0-9_]+)$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_user_name($key, $input, $setting = null, $param = null)
    {
        return Validation_Structure::validate_valid_userName($key, $input, $setting, $param);
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_userName($key, $input, $setting = null, $param = null)
    {
        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([a-zA-Z0-9äöüÄÖÜß]+)$%');
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param  [[Type]] $key              [[Description]]
     * @param  [[Type]] $input            [[Description]]
     * @param  [[Type]] [$setting = null] [[Description]]
     * @param  [[Type]] [$param = null]   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public static function validate_valid_timestamp($key, $input, $setting = null, $param = null)
    {
        return self::validate_valid_integer($key, $input, $setting, null);
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
    public static function validate_valid_alpha($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (!is_string($input[$key])) {
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([a-zA-Z]+)$%');
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
    public static function validate_valid_alpha_space($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (!is_string($input[$key])) {
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([a-zA-Z\h]+)$%');
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
    public static function validate_valid_integer($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }
        
        if (is_int($input[$key]) || (is_float($input[$key]) && floor($input[$key]) === $input[$key])){
            return;
        }

        if (is_string($input[$key])) {
            return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([0-9-]+)$%');
        }

        if (!is_int((int) $input[$key])) {
            return false; // other non-integer value or exceeds PHP_MAX_INT
        }

        if (!is_string($input[$key])){
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
    public static function validate_valid_alpha_numeric($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (!is_string($input[$key])) {
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([0-9a-zA-Z]+)$%');
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
    public static function validate_valid_alpha_space_numeric($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key]) || (is_string($input[$key]) && empty($input[$key]))) {
            return;
        }

        if (!is_string($input[$key])) {
            return false;
        }

        return Validation_Condition::validate_satisfy_regex($key, $input, $setting, '%^([0-9a-zA-Z\h]+)$%');
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
    public static function validate_valid_json($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key])) {
            return;
        }
        
        if (!is_string($input[$key])){
            return false;
        }
        
        if ($input[$key] == '' || $input[$key] == '[]'){
            return;
        }

        $temp = @json_decode($input[$key]);

        if ($temp === null) {
            return false;
        }
        
        if (!is_object($temp)){
            return false;
        }

        return;
    }
}
