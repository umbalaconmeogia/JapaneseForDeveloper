<?php
namespace app\models;

use yii\web\UploadedFile;
use batsg\helpers\HFile;

class FolderUpload extends Folder
{
    
    /**
     * @var UploadedFile
     */
    public $uploadFile;

    public function rules()
    {
        return [
            [['uploadFile'], 'safe'],
        ];
    }
    
    /**
     * Process upload file specified by $uploadFile.
     */
    public function upload()
    {
        // Ensure folder exist.
        $folderPath = $this->getFolderPath(TRUE);
        $extension = strtolower($this->uploadFile->extension);
        if ($extension == 'zip') {
            $this->unzipUploadedFile();
        } else if (File::isSupportedFileExtension($extension)) {
            $this->saveUploadedFile();
        }
    }
    
    /**
     * Get processable files.
     * @return string[]
     */
    public function getFiles()
    {
        $result = [];
        foreach (HFile::listFileRecursively($this->folderPath) as $file) {
            if (File::isSupportedFile($file)) {
                $result[] = $file;
            }
        }
        return $result;
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