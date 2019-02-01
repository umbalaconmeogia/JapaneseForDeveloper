<?php
namespace app\models;

/**
 * Wrapper for PhpOffice
 */
class HPhpOffice
{

    public static function getText($filePath)
    {

    }

    public static function getTextWord2007($filePath)
    {
        $office = \PhpOffice\PhpWord\IOFactory::load($filePath);
        $office->save("a.html", 'HTML');
    }
}