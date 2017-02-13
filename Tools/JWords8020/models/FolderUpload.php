<?php
namespace app\models;

use yii\web\UploadedFile;
use batsg\helpers\HFile;

class FolderUpload extends Folder
{
    /**
     * @var File[]
     */
    private $files;
    
    public static $supportedFileExtension = [
        'txt' => 'テキスト',
        'doc' => 'MS Word',
        'docx' => 'MS Word',
        'pdf' => 'PDF',
    ];
    
    /**
     * @var UploadedFile
     */
    public $uploadFile;
    
    public function upload()
    {
        // Ensure folder exist.
        $folderPath = $this->getFolderPath(TRUE);
        $extension = strtolower($this->uploadFile->extension);
        if ($extension == 'zip') {
            $this->unzipUploadedFile();
        } else if (isset(self::$supportedFileExtension[$extension])) {
            $this->saveUploadedFile();
        }
        $files = HFile::listFile($this->folderPath);
        print_r($files);
        
        die;
    }
    
    private function unzipUploadedFile()
    {
        $zipFile = $this->uploadFile->tempName;
        $zip = new \ZipArchive();
        if ($zip->open($zipFile) === TRUE) {
            $zip->extractTo($this->folderPath);
            $zip->close();
        } else {
            throw new \Exception("Error while unzip $zipFile into {$this->folderPath}.");
        }
    }
    
    private function saveUploadedFile()
    {
        $extension = strtolower($this->uploadFile->extension);
        $originalFileName = $this->uploadFile->baseName . ".$extension";
        $this->uploadFile->saveAs($this->filePath($originalFileName));
    }
}