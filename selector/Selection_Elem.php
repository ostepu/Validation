<?php

include_once dirname(__FILE__) . '/../Validation_Interface.php';

class Selection_Elem implements Validation_Interface
{
    private static $indicator = 'elem';

    public static function getIndicator()
    {
        return self::$indicator;
    }

}