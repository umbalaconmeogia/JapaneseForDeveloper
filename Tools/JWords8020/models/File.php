<?php
namespace app\models;

use yii\base\Model;
use batsg\helpers\HFile;

class File extends Model
{
    public static $supportedFileExtension = [
        'txt' => 'テキスト',
        'doc' => 'MS Word',
        'docx' => 'MS Word',
        'pdf' => 'PDF',
    ];
    
    /**
     * Check if a file is supported (can statistic) by its file ext.
     * @param string $filePath
     * @return boolean
     */
    public static function isSupportedFile($filePath)
    {
        return self::isSupportedFileExtension(HFile::fileExtension($filePath));
    }

    /**
     * Check if a file extension is supported one.
     * @param string $fileExt
     * @return boolean
     */
    public static function isSupportedFileExtension($fileExt)
    {
        return isset(self::$supportedFileExtension[strtolower($fileExt)]);
    }
}