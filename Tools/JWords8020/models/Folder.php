<?php
namespace app\models;

use yii\base\Model;
use batsg\helpers\HRandom;
use batsg\helpers\HFile;

/**
 * @property string $folderPath
 */
class Folder extends Model
{
    private $folderPath;
    
    /**
     * Get root directory of upload files and extracted folders.
     * @return string
     */
    public static function uploadRoot()
    {
        return \Yii::getAlias('@app/runtime/upload');
    }
    
    /**
     * Folder to save upload file.
     * @return string
     */
    public static function uploadFileFolder()
    {
        return self::uploadRoot() . '/uploadFiles';
    }
    
    /**
     * @return string
     */
    public static function folderRoot()
    {
        return self::uploadRoot() . '/folders';
    }
    
    /**
     * @return string
     */
    public static function generateFolderId()
    {
        return date('Ymd_His_') . HRandom::generateRandomString(4);
    }
    
    /**
     * @return string
     */
    public function getFolderPath($createFolder = FALSE)
    {
        if (!$this->folderPath) {
            $this->folderPath = self::folderRoot() . '/' . self::generateFolderId();
        }
        
        // Create folder if specified.
        if ($createFolder && !is_dir($this->folderPath)) {
            if (!mkdir($this->folderPath, 0777, TRUE)) {
                throw new Exception("Error while creating image folder {$this->folderPath}.");
            }
        }
        
        return $this->folderPath;
    }
    
    public function filePath($fileName)
    {
        return $this->folderPath . '/' . $fileName;
    }
    
    /**
     * Delete folder.
     */
    public function delete()
    {
        HFile::rmdir($this->folderPath);
    }
}