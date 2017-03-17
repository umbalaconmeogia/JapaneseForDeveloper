<?php
namespace app\models;

use yii\base\Model;
use batsg\helpers\HFile;

class File extends Model
{
    public static $supportedFileExtension = [
        'txt' => 'テキスト',
        'docx' => 'MS Word',
        'pptx' => 'MS Powerpoint',
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

    /**
     * Get text content from an supported file.
     * @param unknown $filePath
     * @return string
     */
    public static function getText($filePath)
    {
        $result = NULL;
        $fileToText = NULL;
        $fileExt = strtolower(HFile::fileExtension($filePath));
        switch ($fileExt)
        {
            case 'txt':
                $fileToText = new FileText();
                $fileToText->loadFile($filePath);
                break;
            case 'docx':
                $fileToText = new FileDoc();
                $fileToText->loadFile($filePath);
                break;
            case 'pptx':
                $fileToText = new FilePptx();
                $fileToText->loadFile($filePath);
                break;    
            case 'pdf':
                $fileToText = new FilePdf();
                $fileToText->loadFile($filePath);
                break;
            default:
                break;
        }
        if ($fileToText) {
            $result = $fileToText->getTextUtf8();
        }
        return $result;
    }
}