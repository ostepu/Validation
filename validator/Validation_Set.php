<?php
class Validation_Set implements Validation_Interface
{
    private static $indicator = 'set';

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
     * @return [[Type]] [[Description]]
     */
    public static function validate_set_default($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($input[$key])) {
            return array('valid'=>true, 'field'=>$key, 'value'=>$param);
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
    public static function validate_set_copy($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError'] || !isset($input[$key])) {
            return;
        }

        if (!isset($param)) {
            throw new Exception('Validation rule \''.__METHOD__.'\', missing parameter.');
        }

        return array('valid'=>true, 'field'=>$param, 'value'=>$input[$key]);
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
    public static function validate_set_value($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        return array('valid'=>true, 'field'=>$key, 'value'=>$param);
    }

    /**
     * Setzt das Feld $key auf value
     * @author Till Uhlig
     * @param  string $key              Das Zielfeld
     * @param  array $input            [[Description]]
     * @param  array $setting = null Die Umgebung
     * @param  array $param  (value = der Wert für $key)
     * @return array [[Description]]
     */
    public static function validate_set_field_value($key, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param['value'])) {
            throw new Exception('Validation rule \''.__METHOD__.'\', missing \'value\'.');
        }

        return array('valid'=>true, 'field'=>$key, 'value'=>$param);
    }

    /**
     * [[Description]]
     * @author Till Uhlig
     * @param [[Type]] $key              [[Description]]
     * @param [[Type]] $input            [[Description]]
     * @param [[Type]] [$setting = null] [[Description]]
     * @param [[Type]] [$param = null]   [[Description]]
     */
    public static function validate_set_error($key, $input, $setting = null, $param = null)
    {
        if (!isset($param)) {
            throw new Exception('Validation rule \''.__METHOD__.'\', missing parameter.');
        }

        $setting['setError'] = $param;

        return;
    }
}
