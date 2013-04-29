<?php

class DateFormatter
{
    /**
     * Returns a long formatted date (eg, Wednesday, May 26, 2013)
     * 
     * @param  date $date   The date to format
     * @return string       The returned value
     */
    public static function long($date)
    {
        return date_create($date)->format('l, F j, Y');
    }

    public static function short($date)
    {
        
    }

}