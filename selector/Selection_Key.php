<?php

include_once dirname(__FILE__) . '/../Validation_Interface.php';
include_once dirname(__FILE__) . '/../Validation.php';

class Selection_Key implements Validation_Interface
{
    private static $indicator = 'key';

    public static function getIndicator()
    {
        return self::$indicator;
    }

    public static function select_key($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter.');
        }

        return array('keys'=>array($param));
    }

    public static function select_key_list($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter.');
        }

        if (!is_array($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', array required.');
        }

        return array('keys'=>$param);
    }

    public static function select_key_all($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        return array('keys'=>$keys);
    }

    public static function select_key_regex($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter (regex).');
        }

        $tempKeys = array();
        foreach($keys as $key){
            if (preg_match($param, $key) === 1) {
                $tempKeys[] = $key;
            }
        }

        return array('keys'=>$tempKeys);
    }

    public static function select_key_numeric($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        $tempKeys = array();
        foreach($keys as $key){
            if (is_int($key)){
                $tempKeys[] = $key;
                continue;
            }
            if (is_string($key) && !ctype_digit($key)) {
                continue;
            }
            if (!is_int((int) $input[$key])) {
                continue;
            }
            $tempKeys[] = $key;
        }         

        return array('keys'=>$tempKeys);
    }

    public static function select_key_integer($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        $tempKeys = array();
        foreach($keys as $key){
            if (is_int($key)){
                $tempKeys[] = $key;
            }
        }

        return array('keys'=>$tempKeys);
    }

    public static function select_key_min_numeric($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }
        
        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter (min value).');
        }
        
        $res = self::select_key_numeric($keys, $input, $setting, $param);
        
        $tempKeys = array();
        foreach($res['keys'] as $key){
            if ($key >= $param){
                $tempKeys[] = $key;
            }
        }

        return array('keys'=>$tempKeys);
        
    }

    public static function select_key_max_numeric($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }
        
        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter (max value).');
        }

        $res = self::select_key_numeric($keys, $input, $setting, $param);
        
        $tempKeys = array();
        foreach($res['keys'] as $key){
            if ($key <= $param){
                $tempKeys[] = $key;
            }
        }

        return array('keys'=>$tempKeys);
    }

    public static function select_key_starts_with($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }
        
        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter (prefix).');
        }
        
        // eventuell kann man auch eine Liste, mit Präfixen, angeben
        
        $tempKeys = array();
        foreach($keys as $key){
            if (substr($key,0,strlen($param)) === $param){
                $tempKeys[] = $key;
            }
        }

        return array('keys'=>$tempKeys);
    }

    public static function select_key_union($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter.');
        }

        $tempKeys = array();
        $f = new Validation([], ['setError'=>false]);
        $rules = $f->convertSelector($param);
        
        foreach($rules as $selector){
            $m = $f->collectKeys($keys,[$selector]);
            $tempKeys = array_merge(array_values($tempKeys), array_values($m));
        }

        return array('keys'=>$tempKeys);
    }

    public static function select_key_intersection($keys, $input, $setting = null, $param = null)
    {
        if ($setting['setError']) {
            return;
        }

        if (!isset($param)){
            throw new Exception('Selection rule \''.__METHOD__.'\', missing parameter.');
        }

        $tempKeys = null;
        $f = new Validation([], ['setError'=>false]);
        $rules = $f->convertSelector($param);

        foreach($rules as $selector){
            $m = $f->collectKeys($keys,[$selector]);
            if ($tempKeys === null){
                $tempKeys = array_values($m);
            } else {
                $tempKeys = array_intersect(array_values($tempKeys), array_values($m));  
            }
        }

        if ($tempKeys === null){
            $tempKeys = array();
        }

        return array('keys'=>array_values($tempKeys));
    }
}